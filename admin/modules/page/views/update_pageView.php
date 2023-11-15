<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA TRANG</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $page['page_title'] ?>">
                    </div>
                    <?php echo form_error("title") ?>
                    <div class="form-group">
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input class="form-control" type="slug" name="slug" id="slug" value="<?php echo $page['slug'] ?>">
                    </div>
                    <?php echo form_error("slug") ?>

                    <div class="form-group">
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor" class="form-inline form-control"><?Php echo $page['page_content'] ?></textarea><br>
                        <?php echo form_error("desc") ?>
                    </div>
                    <button type="submit" name="update-page" class="btn btn-primary">Thêm mới</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>