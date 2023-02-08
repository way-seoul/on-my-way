<?php 
    $title = 'ON MY WAY | DASHBOARD';
    ob_start();
?>
<script src="public/user.js" defer></script>

<div class="container admin-view">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="admin-title row align-items-center justify-content-between">
            <div class="col-6">
                <h2>Users</h2>
            </div>
            <div class="col-6">
                <div class="add-btn">
                    <a href="<?= ROOT ?>admin_register">Add New Users ></a>
                </div>
            </div>
        </div>
        <div style="width: 100px; height:100px; display:inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </div>
        <div style="width: 100px; height:100px; display:inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </div>
        <div style="width: 100px; height:100px; display:inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
        </div>
        <div style="width: 100px; height:100px; display:inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Admin</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['first_name']; ?></td>
                            <td><?= $user['last_name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['created_date']; ?></td>
                            <td><?= $user['admin']==1 ? "YES":"NO"; ?></td>
                            <td><a href="<?= ADMIN_EDIT_PATH ?>&id=<?=$user['id']?>">Edit</a></td>
                            <td><button type="button" class="delete-user" name="delete"
                            data-id="<?= $user['id'] ?>">Delete</button></td>
                            <td><button type="button" class="reset-password" name="reset" data-id=<?= $user['id'] ?>>Reset password</button></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="leaders">
            <?php include_once 'view/leaderboardView.php'; ?>
        </div>
    </div>


    <br><br>

    <div class="row">
        <div class="admin-title row align-items-center justify-content-between">
            <div class="col-6">
                <h2>Challenges</h2>
            </div>
            <div class="col-6">
                <div class="add-btn">
                    <a href="<?= CREATE_CHALLENGE_PATH ?>">Add New Challenges ></a>
                </div>
                <div class="add-btn">
                    <a href="<?= LIST_CHALLENGES_PATH ?>">See User View of Challenges List ></a>
                </div>
            </div>
        </div>

        <form action="<?= ADMIN_PATH ?>" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Challenge Name</th>
                        <th>Content</th>
                        <th>Conditions</th>
                        <th>Points</th>
                        <th>Accomplished Users</th>
                        <th>Comments</th>
                        <!-- <th>Creator</th> -->
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($challenges as $challenge) { ?>
                    <tr id="ch-<?= $challenge['name'] ?>">
                        <td><?= $challenge['id']; ?></td>
                        <td><a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge['id']; ?>"><?= $challenge['name']; ?></a></td>
                        <td><?= $challenge['content']; ?></td>
                        <td><?= $challenge['conditions']; ?></td>
                        <td><?= $challenge['score']; ?></td>
                        <td><?= $challenge['user_count']; ?></td>
                        <td><?= $challenge['comment_count']; ?></td>
                        <td><?= $challenge['created_date']; ?></td>
                        <td><?= $challenge['updated_date']; ?></td>
                        <td>
                            <a href="<?= EDIT_CHALLENGE_PATH ?>&id=<?=$challenge['id']?>">Edit</a>
                        </td>
                        <td><button type="submit" name="delete-chll" value="<?= $challenge['id']; ?>">DELETE</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>


    <br><br>

    <div class="row">
    
        <div class="admin-title row align-items-center justify-content-between">
            <div class="col-6">
                <h2>Locations</h2>
            </div>
            <div class="col-6">
                <div class="add-btn">
                    <a href="<?= ADD_PLACE_PATH ?>">Add New Locations ></a>
                </div>
            </div>
        </div>

        <form action="<?= ADMIN_PATH ?>" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Place Name</th>
                        <th>Location</th>
                        <th>Challenges</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($places as $place) { ?>
                    <tr>
                        <td><?= $place['id']; ?></td>
                        <td><?= $place['name']; ?></td>
                        <td><a href="https://www.google.com/maps/search/<?= $place['location'] ?>" target="_blank">On Google Maps ></a></td>
                        <td>
                            <?php if($place['challenges'] != ''): ?>
                                <ol>
                                <?php 
                                    $p_challenges = stringToArray($place['challenges']); 
                                    for ($i=0;$i<count($p_challenges);$i++):
                                ?>
                                    <li><a href="#ch-<?= $p_challenges[$i] ?>"><?= $p_challenges[$i] ?></a></li>
                                    <?php endfor ?>
                                </ol>
                            <?php endif ?>
                        </td>
                        <td><button type="submit" name="delete-Place" value="<?= $place['id'] ?>">DELETE</button></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </form>
    </div>
    <br><br>

</div>


<?php 
    $html = ob_get_clean();
    include 'template.php';
?>