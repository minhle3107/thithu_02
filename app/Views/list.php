<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <!-- other meta tags -->
    <meta property="og:description" content="PHP 2 - OOP Exam - List"/>
    <meta property="og:image" content="https://i.imgur.com/GqNWn2z.png"/>

    <title>Quản lý sách</title>
    <link
            rel="icon"
            type="image/png"
            sizes="56x56"
            href="https://i.imgur.com/GqNWn2z.png"
    />
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
    />
    <link rel="stylesheet" href=""/>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Danh sách sách</h1>
            <a href="<?= ROOT_PATH ?>create" class="btn btn-sm btn-outline-success">Thêm</a>
            <div class="my-3">
                <?php if (!empty($message)) : ?>
                    <div class="alert alert-success"><?= $message ?></div>
                <?php endif; ?>
            </div>
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sách</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Email</th>
                    <th>Ảnh</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($books)) : ?>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td><?= $book->id ?></td>
                            <td><?= $book->tensach ?></td>
                            <td><?= $book->gia ?></td>
                            <td><?= $book->soluong ?></td>
                            <td><?= $book->email ?></td>
                            <td>
                                <img src="<?= ROOT_PATH ?>images/<?= $book->anh ?>" width="100" alt=""/>
                                <!--                                <img src="-->
                                <?php //= $book->image ?><!--" width="100" alt=""/>-->
                            </td>
                            <td>
                                <a href="<?= ROOT_PATH ?>edit?id=<?= $book->id ?>"
                                   class="btn btn-sm btn-primary">Sửa</a>
                                <a href="<?= ROOT_PATH ?>delete?id=<?= $book->id ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có muốn xóa vĩnh viễn sách này không?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có sách nào</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=""></script>
</body>
</html>
