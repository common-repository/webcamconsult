<?php

/**
 * Adds Foo_Widget widget.
 */
class Webcamconsult_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'webcamconsult_widget', // Base ID
                __('Webcamconsult widget', 'webcamconsult'), // Name
                array('description' => __('Plaatst een Webcamconsult widget', 'webcamconsult'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        $locale = substr(get_locale(), 0, 2);
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if($instance['widget_uri'] && $instance['widget_uri'] != '0') { 
            $height = !empty($instance['height']) ? $instance['height'].'px' : '100%';
            $width = !empty($instance['width']) ? $instance['width'].'px' : '100%';
            ?>
            <iframe class="webcamconsult-frontend-iframe" style="<?php echo 'height:'.$height.';width:'.$width.';'?>" src="https://app.webcamconsult.com/widget/<?php echo $instance['widget_uri'];?>?locale=<?php echo $locale?>"></iframe>
        <?php
            
        } else {
            echo __('niets ingesteld', 'webcamconsult');
        }
        
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Nieuwe titel', 'webcamconsult');
        $widget_uri = !empty($instance['widget_uri']) ? $instance['widget_uri'] : '0';
        $width = !empty($instance['width']) ? $instance['width'] : '';
        $height = !empty($instance['height']) ? $instance['height'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Titel:', 'webcamconsult'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('widget_uri')); ?>"><?php _e(esc_attr('Widget:')); ?></label> 
            <select class="widefat webcamconsult-widget-selector" id="<?php echo esc_attr($this->get_field_id('widget_uri')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_uri')); ?>" data-current="<?php echo esc_attr($widget_uri); ?>">
                <option value="0">-</option>
            </select>
            
            <label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php _e('Breedte (px):', 'webcamconsult'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>">
            
            <label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php _e('Hoogte (px):', 'webcamconsult'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($height); ?>">
        </p>
        <script>
            var data = {
                'action': 'get_widgets'
            };
            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function (response) {
                if (response !== '0') {
                    // fill the widget selector
                    var obj = jQuery.parseJSON(response);
                    jQuery(obj).each(function (index, widgetObj) {
                        // fill the selectors
                        jQuery('#<?php echo esc_attr($this->get_field_id('widget_uri')); ?>').append(jQuery('<option />').val(widgetObj._id).text(widgetObj.name));

                    });
                    jQuery('#<?php echo esc_attr($this->get_field_id('widget_uri')); ?>').val(jQuery('#<?php echo esc_attr($this->get_field_id('widget_uri')); ?>').data('current'));
                } else {
                    //there are no widgets, or user id is undefined
                }
            });
        </script>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['widget_uri'] = (!empty($new_instance['widget_uri']) ) ? strip_tags($new_instance['widget_uri']) : '';
        $instance['width'] = (!empty($new_instance['width']) ) ? strip_tags($new_instance['width']) : '';
        $instance['height'] = (!empty($new_instance['height']) ) ? strip_tags($new_instance['height']) : '';

        return $instance;
    }

}

// class Foo_Widget