<?php
/**
 * Connect to database
 */
function db() {
$host     = 'localhost';
$database = 'web_a';
$user     = 'root';
$password = 'mysql';
    
try {
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// throw if have error catch will get it
    // echo "conected";
    return $db;
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
}


/**
 * Create new student record
 */
function createStudent($name, $age, $email, $profile) {
    $conn =db();//hàm để thiết lập kết nối tới cơ sở dữ liệu. Hàm này db()có thể chứa logic kết nối cơ sở dữ liệu và trả về một phiên bản PDO.
    $stmt = $conn->prepare('INSERT INTO student (name , age, email, profile) values (:name , :age, :email, :profile)');
    $stmt->bindParam(':name', $name);//giúp ngăn việc chèn SQL bằng cách tách mã SQL khỏi dữ liệu. Nó đảm bảo rằng đầu vào của người dùng được coi là dữ liệu chứ không phải là mã thực thi.
    $stmt->bindParam(':age', $age);//giúp ngăn việc chèn SQL bằng cách tách mã SQL khỏi dữ liệu. Nó đảm bảo rằng đầu vào của người dùng được coi là dữ liệu chứ không phải là mã thực thi.
    $stmt->bindParam(':email', $email);//
    $stmt->bindParam(':profile', $profile);//

$stmt->execute();//phương thức được gọi trên câu lệnh đã chuẩn bị sẵn ( $stmt)
}

/**
 * Get all data from table student
 */
function selectAllStudents() {
    $stmt = db()->query("SELECT * FROM `student`;");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * Get only one on record by id 
 */
function selectOnestudent($id) {
    $stmt = db()->prepare("SELECT * FROM `student` WHERE id = ?");
    if ($stmt) {
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Prepare statement failed";
        return false;
    };
}

/**
 * Delete student by id
 */
function deleteStudent($id) {
    $stmt = db()->prepare("DELETE FROM `student` WHERE id = :id");
    if ($stmt) {
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } else {
        echo "Prepare statement failed";
        return false;
    }
}


/**
 * Update students
 * 
 */
function updateStudent($value_update, $id) {
    $stmt = db()->prepare("UPDATE `student` SET `name` = :name, `age` = :age, `email` = :email, `profile` = :profile WHERE `id` = :id");
    if ($stmt) {
        $stmt->bindParam(':name', $value_update['name']);
        $stmt->bindParam(':age', $value_update['age']);
        $stmt->bindParam(':email', $value_update['email']);
        $stmt->bindParam(':profile', $value_update['image_url']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } else {
        echo "Prepare statement failed";
        exit;
    }
}