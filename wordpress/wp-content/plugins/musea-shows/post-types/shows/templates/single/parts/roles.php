<?php
    if(!empty($roles)){ ?>
        <div class="eltdf-show-roles-holder">
            <?php foreach ($roles as $key => $value_array) { ?>
                <div class="eltdf-show-role">
                    <h6 class="eltdf-show-role-title"><?php echo esc_html($key)?></h6>
                    <ul>
                        <?php foreach ($value_array as $role) { ?>
                            <li>
                                <p>
                                    <span> <?php echo get_the_title($role); ?> </span>
                                </p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    <?php }