<?php 
    $title = 'ON MY WAY | DASHBOARD';
    ob_start();
?>
<script src="public/user.js" defer></script>

<div class="container admin-view">
    <h1>Dashboard</h1>

    <div class="row admin-section">
        <div class="admin-title">
            <div>
                <h2>Users</h2>
            </div>
            <div>
                <div class="add-btn">
                    <a href="<?= ROOT ?>admin_register">New User
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <div>
            <div class="list-box">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>EMAIL</th>
                            <th>CREATED DATE</th>
                            <th>ADMIN</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td class="truncateTxt"><?= $user['first_name']; ?></td>
                                    <td class="truncateTxt"><?= $user['last_name']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['created_date']; ?></td>
                                    <td><?= $user['admin']==1 ? "✓":"-"; ?></td>
                                    <td>
                                        <a href="<?= ADMIN_EDIT_PATH ?>&id=<?=$user['id']?>" class="admin-table-btn" title="Edit">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </div>
                                        </a>
                                        <button type="button" class=" admin-table-btn delete-user" name="delete" data-id="<?= $user['id'] ?>" title="Delete">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </div>
                                        </button>
                                        <button type="button" class="reset-password admin-table-btn" name="reset" data-id=<?= $user['id'] ?> title="Reset PW to 0000">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            </div>
                                        </button>
                                    </td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <div class="row admin-section">
        <div class="admin-title">
            <div>
                <h2>Challenges</h2>
            </div>
            <div>
                <div class="add-btn">
                    <a href="<?= CREATE_CHALLENGE_PATH ?>">New Challenge
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="list-box">
                <table class="admin-table">
                    <form action="<?= ADMIN_PATH ?>" method="POST">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CHALLENGE NAME</th>
                                <th>CONTENT</th>
                                <th>CONDITIONS</th>
                                <th>POINTS</th>
                                <th>WHO COMPLETED</th>
                                <th>NO. OF COMMENTS</th>
                                <!-- <th>Creator</th> -->
                                <th>CREATED DATE</th>
                                <th>UPDATED DATE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($challenges as $challenge) { ?>
                            <tr id="ch-<?= $challenge['name'] ?>">
                                <td><?= $challenge['id']; ?></td>
                                <td><a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge['id']; ?>"><?= $challenge['name']; ?></a></td>
                                <td class="truncateTxt"><?= $challenge['content']; ?></td>
                                <td class="truncateTxt"><?= $challenge['conditions']; ?></td>
                                <td><?= $challenge['score']; ?></td>
                                <td><?= $challenge['user_count']; ?></td>
                                <td><?= $challenge['comment_count']; ?></td>
                                <td><?= $challenge['created_date']; ?></td>
                                <td><?= $challenge['updated_date']; ?></td>
                                <td>
                                    <a href="<?= EDIT_CHALLENGE_PATH ?>&id=<?=$challenge['id']?>" class="admin-table-btn" title="Edit">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </div>
                                    </a>
                                    <button type="submit" name="delete-chll" value="<?= $challenge['id']; ?>" class="admin-table-btn" title="Delete">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </div>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </form>
                </table>
            </div>
            <?= $f_msg_deleteChll ?>
        </div>
    </div>



    <div class="row admin-section">
        <div class="admin-title">
            <div>
                <h2>Locations</h2>
            </div>
            <div>
                <div class="add-btn">
                    <a href="<?= ADD_PLACE_PATH ?>">New Location
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="list-box">
                <table class="admin-table">
                    <form action="<?= ADMIN_PATH ?>" method="POST">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PLACE NAME</th>
                                <th>CHALLENGES</th>
                                <th>LOCATION</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($places as $place) { ?>
                            <tr>
                                <td><?= $place['id']; ?></td>
                                <td><?= $place['name']; ?></td>
                                <td>
                                    <?php if($place['challenges'] != ''): ?>
                                        <ol>
                                        <?php 
                                            $p_challenges = explode(',', $place['challenges']); 
                                            for ($i=0;$i<count($p_challenges);$i++):
                                        ?>
                                            <li><a href="#ch-<?= $p_challenges[$i] ?>"><?= $p_challenges[$i] ?></a></li>
                                            <?php endfor ?>
                                        </ol>
                                    <?php endif ?>
                                </td>
                                <td><a href="https://www.google.com/maps/search/<?= $place['location'] ?>" target="_blank">On Google Maps ></a></td>
                                <td><button type="submit" name="delete-Place" value="<?= $place['id'] ?>" class="admin-table-btn" title="Delete">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </div>
                                </button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </form>
                </table>
            </div>
            <?= $f_msg_deletePlace ?>
        </div>
    </div>

    <div class="row admin-section"></div>

</div>


<?php 
    $html = ob_get_clean();
    include 'template.php';
?>