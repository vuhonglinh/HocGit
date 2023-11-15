<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA BÀI VIẾT</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $post['post_title'] ?>">
                    </div>
                    <?php echo form_error("title") ?>
                    <div class="form-group">
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input class="form-control" type="slug" name="slug" id="slug" value="<?php echo $post['slug'] ?>">
                    </div>
                    <?php echo form_error("slug") ?>

                    <div class="form-group">
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor" class="form-inline form-control"><?php echo $post['post_content'] ?></textarea><br>
                        <?php echo form_error("desc") ?>
                    </div>

                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="img/<?php echo $post['post_img'] ?>" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error("file") ?>

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="Đã đăng" <?php if ($post['status'] == "Đã đăng") echo "selected"; ?>>Đã đăng</option>
                            <option value="Chờ xét duyệt" <?php if ($post['status'] == "Chờ xét duyệt") echo "selected"; ?>>Chờ xét duyệt</option>
                        </select>
                    </div>
                    <?php echo form_error("status") ?>

                    <button type="submit" name="update-post" class="btn btn-primary">Cập nhật</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>