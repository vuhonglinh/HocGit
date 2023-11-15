<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">THÊM MENU</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo set_value("title") ?>">
                    </div>
                    <?php echo form_error("title") ?>
                    <div class="form-group">
                        <label for="url_static">Đường dẫn Url</label>
                        <input class="form-control" type="text" name="url_static" id="url_static" value="<?php echo set_value("url_static") ?>">
                    </div>
                    <?php echo form_error("url_static") ?>

                    <div class="form-group">
                        <label for="parent_id">Menu cha</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">-- Chọn --</option>
                            <?php foreach ($list_parent as $item) : ?>
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error("parent_id") ?>

                    <div class="form-group">
                        <label for="menu_order">Thứ tự</label>
                        <input class="form-control" type="text" name="menu_order" id="menu_order" value="<?php echo set_value("menu_order") ?>">
                    </div>
                    <?php echo form_error("menu_order") ?>

                    <button type="submit" name="sm_add" class="btn btn-primary">Thêm mới</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>