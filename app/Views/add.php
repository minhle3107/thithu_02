<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Minh Le</title>
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
    <div class="mb-3">
        <h1>Thêm sách</h1>
    </div>

    <div class="mb-3">
        <a href="<?= ROOT_PATH ?>" class="btn btn-outline-success">Danh sách</a>
    </div>

    <div class="mb-3">
        <form action="<?= ROOT_PATH ?>create" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="">Tên sách</label>
                <input type="text" class="form-control" name="tensach" value="<?= $data['tensach'] ?? "" ?>"/>
                <span class="text-danger"><?= $errors['tensach'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Giá</label>
                <input type="number" class="form-control" name="gia" value="<?= $data['gia'] ?? "" ?>"/>
                <span class="text-danger"><?= $errors['gia'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Số lượng</label>
                <input type="number" class="form-control" name="soluong" value="<?= $data['soluong'] ?? "" ?>"/>
                <span class="text-danger"><?= $errors['soluong'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $data['email'] ?? "" ?>"/>
                <span class="text-danger"><?= $errors['email'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Hình ảnh</label>
                <input type="file" class="form-control" name="anh"/>
                <span class="text-danger"><?= $errors['anh'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Loại sách</label>
                <select class="form-control" name="maloai">
                    <option value="">Lựa chọn loại sách</option>
                    <?php foreach ($categories as $ls) : ?>
                        <option value="<?= $ls->id ?>"><?= $ls->tenloai ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger"><?= $errors['maloai'] ?? "" ?></span>
            </div>

            <div class="mb-3">
                <label for="">Mô tả</label>
                <textarea class="form-control" name="mota" id="" cols="30"
                          rows="10"><?= $data['mota'] ?? "" ?></textarea>
                <span class="text-danger"><?= $errors['mota'] ?? "" ?></span>
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src=""></script>
</body>
</html>
