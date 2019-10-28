<?php
// defaults to prevent errors
$page_id = $page_id ?? '';
$subject_id = $subject_id ?? '';
$visible = $visible ?? true;


?>
<nav>
    <?php $nav_subjects = find_all_subjects(['visible' => $visible]); ?>
    <ul class="navigation">
        <?php while ($nav_subject = $nav_subjects->fetch(PDO::FETCH_ASSOC)) : ?>
            <li class="<? if ($nav_subject['id'] == $subject_id) echo ' selected' ?>">
                <a href="<? echo url_for("index.php?subject_id=" . h(u($nav_subject['id']))); ?>">
                    <?php echo h($nav_subject["menu_name"]); ?>
                </a>
                <!-- loop to find all pages based in subject id -->
                <?php if ($nav_subject['id'] == $subject_id) : ?>
                    <?php $nav_pages = find_pages_by_subject_id($nav_subject["id"], ['visible' => $visible]); ?>
                    <ul class="">
                        <?php while ($nav_page = $nav_pages->fetch(PDO::FETCH_ASSOC)) : ?>
                            <li class="<? if ($nav_page['id'] == $page_id) echo ' selected' ?>">
                                <a href="<? echo url_for("/index.php?id=" . h(u($nav_page['id']))); ?>">
                                    <?php echo h($nav_page["menu_name"]); ?>
                                </a>
                            </li>

                        <?php endwhile; // nav_pages 
                                ?>
                    </ul>
                <?php endif; ?>

            </li>

        <?php endwhile;  // nav_subject 
        ?>
    </ul>
</nav>