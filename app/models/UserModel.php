<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($firstName, $lastName, $username, $email, $password) {
        try {

            $query = "SELECT COUNT(*) FROM tai_khoan WHERE username = :username OR email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                return "Username or Email already exists.";
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "
                INSERT INTO tai_khoan (firstName, lastName, username, email, password,         registration_date, role)
                VALUES (:firstName, :lastName, :username, :email, :password, CURDATE(), 'User')
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                return "Account created successfully!";
            } else {
                return "Error creating account.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function authenticate($email, $password) {
        $query = "SELECT id, username, email, role, phone_number, password
                  FROM tai_khoan
                  WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);

            if ($user['role'] === 'User') {
                $query = "SELECT u.status FROM user u WHERE u.account_id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $user['id'], PDO::PARAM_INT);
                $stmt->execute();

                $status = $stmt->fetch(PDO::FETCH_ASSOC);
                $user['status'] = $status['status'];
            }
            return $user;
        }

        return null;
    }

    public function getUserInfo($id) {
        $query = "
            SELECT u.id, t.username, t.email, t.phone_number,t.full_name, t.avatar, t.date_of_birth, u.coins,
                   g.id AS game_id, g.game_name, g.price, g.avt
            FROM user u
            JOIN tai_khoan t ON u.id = t.id
            LEFT JOIN don_hang dh ON dh.user_id = u.id
            LEFT JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.order_id
            LEFT JOIN game g ON ctdh.game_id = g.id
            WHERE t.id = :id AND dh.status = 'Paid'" ;

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $userInfo = [
            'id' => $results[0]['id'],
            'username' => $results[0]['username'],
            'email' => $results[0]['email'],
            'phone_number'=> $results[0]['phone_number'],
            'full_name' => $results[0]['full_name'],
            'avatar' => $results[0]['avatar'],
            'date_of_birth' => $results[0]['date_of_birth'],
            'coins' => $results[0]['coins'],
            'games' => []
        ];

        foreach ($results as $game) {
            if (isset($game['game_id']) && $game['game_id']) {
                $userInfo['games'][] = [
                    'game_id' => $game['game_id'],
                    'game_name' => $game['game_name'],
                    'price' => $game['price'],
                    'avt' => $game['avt']
                ];
            }
        }

        return $userInfo;
    }


    public function getShopingCart($id) {
        $query = "
            SELECT u.id, t.username, t.email, t.phone_number,t.full_name, t.avatar, t.date_of_birth, u.coins,
                   g.id AS game_id, g.game_name, g.price, g.avt
            FROM user u
            JOIN tai_khoan t ON u.account_id = t.id
            LEFT JOIN don_hang dh ON dh.user_id = u.id
            LEFT JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.order_id
            LEFT JOIN game g ON ctdh.game_id = g.id
            WHERE t.id = :id AND dh.status = 'Paid'" ;

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $userInfo = [
            'id' => $results[0]['id'],
            'username' => $results[0]['username'],
            'email' => $results[0]['email'],
            'phone_number'=> $results[0]['phone_number'],
            'full_name' => $results[0]['full_name'],
            'avatar' => $results[0]['avatar'],
            'date_of_birth' => $results[0]['date_of_birth'],
            'coins' => $results[0]['coins'],
            'games' => []
        ];

        foreach ($results as $game) {
            if (isset($game['game_id']) && $game['game_id']) {
                $userInfo['games'][] = [
                    'game_id' => $game['game_id'],
                    'game_name' => $game['game_name'],
                    'price' => $game['price'],
                    'avt' => $game['avt']
                ];
            }
        }

        return $userInfo;
    }

    public function deleteShoppingCart($userId, $gameId) {
        try {
            $this->db->beginTransaction();

            $getOrderQuery = "
                SELECT dh.id FROM don_hang dh
                JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.order_id
                WHERE dh.user_id = :user_id AND dh.status = 'Pending' AND ctdh.game_id = :game_id
                LIMIT 1";

            $stmt = $this->db->prepare($getOrderQuery);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
            $stmt->execute();

            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($order) {
                $orderId = $order['id'];

                // Xóa chi tiết đơn hàng
                $deleteOrderDetailsQuery = "
                    DELETE FROM chi_tiet_don_hang
                    WHERE order_id = :order_id AND game_id = :game_id";

                $stmt = $this->db->prepare($deleteOrderDetailsQuery);
                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
                $stmt->execute();

                $checkOrderDetailsQuery = "
                    SELECT COUNT(*) AS count FROM chi_tiet_don_hang
                    WHERE order_id = :order_id";

                $stmt = $this->db->prepare($checkOrderDetailsQuery);
                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->execute();

                $countResult = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($countResult['count'] == 0) {
                    // Cập nhật trạng thái đơn hàng nếu không còn chi tiết
                    $updateOrderStatusQuery = "
                        UPDATE don_hang
                        SET status = 'Canceled'
                        WHERE id = :order_id";

                    $stmt = $this->db->prepare($updateOrderStatusQuery);
                    $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function updateProfile($user_id, $username, $phone, $url_link, $birth) {
        // Câu lệnh SQL để cập nhật thông tin người dùng
        $query = "
            UPDATE tai_khoan
            SET username = :username, phone_number = :phone, avatar = :url_link, date_of_birth = :birth
            WHERE id = :user_id
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':url_link', $url_link, PDO::PARAM_STR);
        $stmt->bindParam(':birth', $birth, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
