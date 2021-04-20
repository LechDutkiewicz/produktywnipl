<?php
/**
 * Custom widgets for this theme.
 *
 * @package stealen from Esthétique
 */

if ( !defined('ABSPATH') )
	die('-1');

add_action( 'widgets_init', function() {
		register_widget( 'NorthNinja_Banner' );
		register_widget( 'NorthNinja_Newsletter' );
});

/**
 * Adds North Ninja Simple Banner widget.
 */
class NorthNinja_Banner extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'northninja_banner', // Base ID
			esc_html__('Produktywni: Reklama', 'esthetique'), // Name,
			array(
				'classname'=> 'northninja_widget_banner', // Class
				'description' => esc_html__( 'Simple ad or just box.', 'esthetique' ),
			) // Args
		);

		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}

 /**
  * Upload the Javascripts for the media uploader
  */
	public function upload_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/assets/scripts/util/uploadMedia.js', array('jquery'));
  }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

    echo $args['before_widget'];

		if ( empty( $instance['button-text'] ) ) {
			$banner_container = '<div style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</div>';
		} else {
			$banner_container = '<a href="%1$s" style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</a>';
		}

		$banner_container = '<div style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</div>';

		$title = ! empty( $instance['title'] ) ?  '<h3 class="widget-banner__title">' . esc_html( $instance['title'] ) . '</h3>' : null;
		$subtitle = ! empty( $instance['subtitle'] ) ? '<p class="widget-banner__subheading">' . esc_html( $instance['subtitle'] ) . '</p>' : null;
		$button = ! empty( $instance['button-text'] ) ? '<a href="' . esc_url( $instance['button-url'] ) . '" target="_blank" rel="nofollow" class="btn btn--border-white btn--full-width">' . esc_html( $instance['button-text'] ) . '</a>' : null;

		$banner_content = '<div class="banner-inner">' . $subtitle . $title . $button . '</div>';

		printf(
			$banner_container,
			esc_url( $instance['button-url'] ),
			esc_url( $instance['image'] ),
			$banner_content
		);

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$image = '';
		$title = '';
		$subtitle = '';
		$button_text = '';
		$button_url = '';

		if( isset($instance[ 'image' ] ) ) {
      $image = $instance[ 'image' ];
    }

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}

    if( isset($instance[ 'subtitle' ] ) ) {
      $subtitle = $instance[ 'subtitle' ];
    }

    if( isset($instance[ 'button-text' ] ) ) {
      $button_text = $instance[ 'button-text' ];
    }

    if( isset($instance[ 'button-url' ] ) ) {
      $button_url = $instance[ 'button-url' ];
    }

		?>
		<p>
    	<label for="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"><?php esc_html_e( 'Image:', 'esthetique' ); ?></label>
      <input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" value="<?php echo esc_attr( $image ); ?>">
      <input type="button" class="button button-primary custom_media_button northninja_upload_media_button" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>_button" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php esc_attr_e( 'Upload Image', 'esthetique' ); ?>" style="margin-top: 5px;" data-size="thumbnail_banner">
    </p>

    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>">
		</p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'button-text' ) ); ?>"><?php esc_html_e( 'Button text:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button-text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button-text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'button-url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'esthetique' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button-url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button-url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>">
    </p>

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
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
		$instance['button-text'] = ( ! empty( $new_instance['button-text'] ) ) ? strip_tags( $new_instance['button-text'] ) : '';
		$instance['button-url'] = ( ! empty( $new_instance['button-url'] ) ) ? strip_tags( $new_instance['button-url'] ) : '';

		return $instance;
	}

} // class NorthNinja_Banner

/**
 * Adds North Ninja Simple Banner widget.
 */
class NorthNinja_Newsletter extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'northninja_newsletter', // Base ID
			esc_html__('Produktywni: Newsletter', 'esthetique'), // Name,
			array(
				'classname'=> 'northninja_widget_newsletter', // Class
				'description' => esc_html__( 'Newsletter Box.', 'esthetique' ),
			) // Args
		);

		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}

 /**
  * Upload the Javascripts for the media uploader
  */
	public function upload_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/assets/scripts/util/uploadMedia.js', array('jquery'));
  }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

    echo $args['before_widget'];

		if ( empty( $instance['button-text'] ) ) {
			$banner_container = '<div style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</div>';
		} else {
			$banner_container = '<a href="%1$s" style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</a>';
		}

		$banner_container = '<div style="background-image: url(\'%2$s\');" class="widget widget-banner banner--pkpk">%3$s</div>';

		$title = ! empty( $instance['title'] ) ?  '<h3 class="widget-banner__title">' . esc_html( $instance['title'] ) . '</h3>' : null;
		$subtitle = ! empty( $instance['subtitle'] ) ? '<p class="widget-banner__subheading">' . esc_html( $instance['subtitle'] ) . '</p>' : null;
		$content = ! empty( $instance['button-text'] ) ? '<p class="widget-banner__content">' . esc_html( $instance['button-text'] ) . '</p>' : null;


		$form = '<form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post" style="position: relative;" class="d-flex flex-wrap getresponse-form" validate>
          <input type="text" name="name" class="name" placeholder="' . __('Twoje imię', 'produktywni') . '" style="width: 100%;" required/>
          <!-- Pole email (wymagane) -->
          <input type="email" name="email" class="email" placeholder="' . __('Twój adres e-mail', 'produktywni') . '" style="width: 100%;" required/>
          <!-- Token kampanii -->
          <!-- Pobierz token na: https://app.getresponse.com/campaign_list.html -->
          <input type="hidden" name="campaign_token" value="VX9bP" />
          <!-- Thank you page (optional) -->
          <input type="hidden" name="thankyou_url" value="' . get_field("getresponse_submit_hero", "options") . '"/>
          <!-- Przycisk zapisu -->
          <input type="submit" value="' . __('Zapisz się', 'produktywni') . '" class="btn btn--large btn--green btn--subscribe" style="top: 0" data-ga-action="newsletter-widget"/>
        </form>';

		$banner_content = '<div class="banner-inner">' . $subtitle . $title . $content . $form . '</div>';

		printf(
			$banner_container,
			esc_url( $instance['button-url'] ),
			esc_url( $instance['image'] ),
			$banner_content
		);

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$image = '';
		$title = '';
		$subtitle = '';
		$button_text = '';

		if( isset($instance[ 'image' ] ) ) {
      $image = $instance[ 'image' ];
    }

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}

    if( isset($instance[ 'subtitle' ] ) ) {
      $subtitle = $instance[ 'subtitle' ];
    }

    if( isset($instance[ 'button-text' ] ) ) {
      $button_text = $instance[ 'button-text' ];
    }

		?>
		<p>
    	<label for="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"><?php esc_html_e( 'Image:', 'esthetique' ); ?></label>
      <input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" value="<?php echo esc_attr( $image ); ?>">
      <input type="button" class="button button-primary custom_media_button northninja_upload_media_button" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>_button" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php esc_attr_e( 'Upload Image', 'esthetique' ); ?>" style="margin-top: 5px;" data-size="thumbnail_banner">
    </p>

    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>">
		</p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'button-text' ) ); ?>"><?php esc_html_e( 'Button text:', 'esthetique' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button-text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button-text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
    </p>
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
		$instance['button-text'] = ( ! empty( $new_instance['button-text'] ) ) ? strip_tags( $new_instance['button-text'] ) : '';
		$instance['button-url'] = ( ! empty( $new_instance['button-url'] ) ) ? strip_tags( $new_instance['button-url'] ) : '';

		return $instance;
	}

} // class NorthNinja_Banner