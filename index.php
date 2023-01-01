<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
</head>
<body>

<h1>TODOアプリ</h1>
<h2>
    新規作成
</h2>

<?php 

session_start();
$self_url = $_SERVER['PHP_SELF'];

?> 


<form action="<?php echo $self_url ?>" method="POST">
    <input type="text" name="task">
    <input type="submit" name="type" value="create">
</form>

<?php 

if(isset($_POST['type'])){

    if($_POST['type'] === 'create') {
        
        $_SESSION['todos'][] = $_POST['task'];
        echo "新しいタスク[{$_POST['task']}]が追加されました。";
    
    } else if($_POST['type'] === 'update') {

        $_SESSION['todos'][$_POST['id']] = $_POST['task'];
        echo "タスク[{$_POST['task']}]の名前が変更されました。";

    } else if($_POST['type'] === 'delete') {
        array_splice($_SESSION['todos'], $_POST['id'], 1);
        echo "タスク[{$_POST['task']}]が削除されました。";
    }

    if(empty($_SESSION['todos'])) {
        $_SESSION['todos'] = [];
        echo 'タスクを入力しましょう！';
        die();
    }

    header("Location: $self_url");
    exit;
}

?>


<h2>
    タスク一覧
</h2>

<ul>
    <?php if (isset($_SESSION['todos'])) : ?>
        <?php for($i = 0; $i < count($_SESSION['todos']); $i++): ?>
            <ul>
                <li>
                    <form action="<?php echo $self_url; ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $i; ?>">
                        <span><?php echo $i; ?></span>
                        <span>:</span>
                        <input type="text" name="task" value="<?php echo $_SESSION['todos'][$i] ?>">
                        <input type="submit" name="type" value="delete">
                        <input type="submit" name="type" value="update">
                    </form>
                </li>
            </ul>
        <?php endfor; ?>
    <?php endif; ?>
</ul>

</body>
</html>