<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>

<title>サンプル</title>
</head>

<body>




<?php

$idh=$_POST["idh"];
$passwordh=$_POST["passwordh"];

	$dsn='データベース名'; 
	$user='ユーザー名';
	$password='パスワード';
	$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE =>
	PDO::ERRMODE_WARNING));

	$sql="CREATE TABLE IF NOT EXISTS tb" //テーブルを作成
	."("
	."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
	."name char(32) NOT NULL,"
	."comment TEXT NOT NULL,"
	."date TEXT,"
	."password char(14) NOT NULL"
	.");";
	$stmt=$pdo->query($sql);



	if(!empty($idh)==true and !empty($passwordh)==true){ //編集機能①

	$idh=$_POST["idh"];					
	$sql="select*from tb where id='$idh';";
	$stmt=$pdo->query($sql);
	

	foreach($stmt as $row){

	if($row[0]==$idh && $row[4]==$passwordh){

	$doronh = $row['id'];
	$nameh = $row['name'];
	$commenth = $row['comment'];

}


}
}


?>


<h1>簡易掲示板</h1>
<form method="post" action="mission_4-1_takayama.php">
<input type="text" name="name" placeholder="名前" value="<?php echo $nameh; ?>"><br/>
<input type="text" name="comment" placeholder="コメント" value="<?php echo $commenth; ?>"><br/>
<input type="text" name="password" placeholder="パスワード">
<input type="submit" value="送信"><br/>
<input type="hidden" name="doron" value="<?php echo $doronh; ?>"><br/>

<input type="text" name="idd" placeholder="削除対象番号"><br/>
<input type="text" name="passwordd" placeholder="パスワード">
<input type="submit" value="送信"><br/><br/>

<input type="text" name="idh" placeholder="編集対象番号"><br/>
<input type="text" name="passwordh" placeholder="パスワード">
<input type="submit" value="送信"><br/><br/>

<?php


	$name = $_POST["name"];
	$comment = $_POST["comment"];
	$date = date("Y/m/d/H:i:s");
	$password = $_POST["password"];
	$idd = $_POST["idd"];
	$passwordd = $_POST["passwordd"];
	$doron = $_POST["doron"];

	if(!empty($doron)==true){		//編集②


	$id = $_POST["doron"];
	$name=$_POST["name"];
	$comment=$_POST["comment"];
	$date = date("Y/m/d/H:i:s");
	$password = $_POST["password"];

	$sql='update tb set name=:name,comment=:comment,date=:date where id=:id AND password=:password';
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':name',$name,PDO::PARAM_STR);
	$stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
	$stmt->bindParam(':date',$date,PDO::PARAM_STR);
	$stmt->bindParam(':id',$id,PDO::PARAM_INT);
	$stmt->bindParam(':password',$password,PDO::PARAM_STR);
	$stmt->execute();
}



	if(!empty($idd)==true and !empty($passwordd)==true){ //削除機能
	$id=$_POST["idd"];
	$password = $_POST["passwordd"];
	$sql='delete from tb where id=:id AND password=:password';
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id,PDO::PARAM_INT);
	$stmt->bindParam(':password',$password,PDO::PARAM_INT);
	$stmt->execute();


}



	if(trim($name)==false or trim($comment)==false or trim($password)==false){ //投稿機能

	$name != $_POST["name"];
	$commnet != $_POST["comment"];
	$password != $_POST["password"];

}elseif(empty($doron)===true){



	$sql = $pdo -> prepare("INSERT INTO tb (name,comment,date,password) VALUES (:name,:comment,:date,:password)");

	$sql -> bindParam(':name', $name, PDO::PARAM_STR); 
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':date', $date, PDO::PARAM_STR); 
	$sql -> bindParam(':password', $password, PDO::PARAM_STR); 
	$name = $_POST["name"];
	$comment = $_POST["comment"];
	$date = date("Y/m/d/H:i:s");
	$password = $_POST["password"];
	$sql -> execute();


	}

	$sql='SELECT*FROM tb order by id asc';
	$stmt=$pdo->query($sql);
	$results=$stmt->fetchAll();
	foreach($results as $row){
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].',';
	echo $row['date'].'<br>';
}

?>
</from>
</body>
<html>
