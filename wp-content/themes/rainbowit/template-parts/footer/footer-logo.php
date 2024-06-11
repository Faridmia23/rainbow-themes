<?php

/**
* Load Logo
*/

// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();

if ( isset($rainbowit_options['rainbowit_logo_type']) ): ?>
    <a href="<?php echo esc_url(home_url('/')); ?>"
       title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">

        <?php if ('image' == $rainbowit_options['rainbowit_logo_type']): ?>

            <img class="logo-normal logo-light" src="<?php echo esc_url($rainbowit_options['rainbowit_head_logo']['url']); ?>"
                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>">

            <?php if(!empty($rainbowit_options['rainbowit_head_logo_dark']['url'])){ ?>
                <img class="logo-sticky logo-dark" src="<?php echo esc_url($rainbowit_options['rainbowit_head_logo_dark']['url']); ?>"
                     alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            <?php } ?>

        <?php else: ?>

            <?php if ('text' == $rainbowit_options['rainbowit_logo_type']): ?>

                <?php echo esc_html($rainbowit_options['rainbowit_logo_text']); ?>

            <?php endif ?>

        <?php endif ?>

    </a>
<?php else: ?>

    <h3>
        <a href="<?php echo esc_url(home_url('/')); ?>"
           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
            <?php if (isset($rainbowit_options['rainbowit_logo_text']) ? $rainbowit_options['rainbowit_logo_text'] : '') {
                echo esc_html($rainbowit_options['rainbowit_logo_text']);
            } else {
                bloginfo('name');
            }
            ?>
        </a>
    </h3>

    <?php $description = get_bloginfo('description', 'display');

    if ($description || is_customize_preview()) { ?>

        <p class="site-description"><?php echo esc_html($description); ?> </p>

    <?php } ?>

<?php endif ?>