<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 12:41
 */
?>
<?php require_once(ROOT . '/template/html/header.php') ?>
<div class="container">
    <div class="row">
        <?php if (!empty($data['vk_user'])): ?>
            <div class="col-sm-12">
                <h2>Аккаунты VK</h2>
                <hr>
                <div class="row">
                    <?php foreach ($data['vk_user'] as $item): ?>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3><?php echo $item['first_name_vk'] . ' ' . $item['last_name_vk']; ?></h3>
                                </div>
                                <div class="col-sm-3">
                                    <form action="listaccounts" method="post">
                                        <br>
                                        <input type="hidden" name="id" value="<?php echo  $item['id']; ?>">
                                        <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                        <button type="submit" name="submit_account_delete" class="btn btn-xs btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                            <h4><?php echo 'id' . $item['id_vk']; ?></h4>
                            <h5><?php echo 'Аккаунт добавлен: ' . $item['changed_date']; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br><br>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['vk_groups'])): ?>
            <div class="col-sm-12">
                <h2>Группы VK</h2>
                <hr>
                <div class="row">
                    <?php foreach ($data['vk_groups'] as $item): ?>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3><?php echo $item['name']; ?></h3>
                                </div>
                                <div class="col-sm-3">
                                    <form action="listaccounts" method="post">
                                        <br>
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                        <button type="submit" name="submit_account_delete" class="btn btn-xs btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                            <h4><?php echo 'id' . $item['id_groups']; ?></h4>
                            <h5><?php echo 'Группа добавлена: ' . $item['date']; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br><br>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['ok_groups'])): ?>
            <div class="col-sm-12">
                <h2>Группы из Одноклассников</h2>
                <hr>
                <div class="row">
                    <?php foreach ($data['ok_groups'] as $item): ?>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3><?php echo $item['name']; ?></h3>
                                </div>
                                <div class="col-sm-3">
                                    <form action="listaccounts" method="post">
                                        <br>
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                        <button type="submit" name="submit_account_delete" class="btn btn-xs btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                            <h4><?php echo 'id' . $item['id_groups']; ?></h4>
                            <h5><?php echo 'Группа добавлена: ' . $item['date']; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br><br>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['instagram'])): ?>
            <div class="col-sm-12">
                <h2>Аккаунты Instagram</h2>
                <hr>
                <div class="row">
                    <?php foreach ($data['instagram'] as $item): ?>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3><?php echo $item['name']; ?></h3>
                                </div>
                                <div class="col-sm-3">
                                    <form action="listaccounts" method="post">
                                        <br>
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                        <button type="submit" name="submit_account_delete" class="btn btn-xs btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                            <h5><?php echo 'Аккаунт добавлен: ' . $item['date']; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br><br>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once(ROOT . '/template/html/footer.php') ?>
