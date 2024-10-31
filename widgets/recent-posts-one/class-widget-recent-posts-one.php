<?php
/**
 * The sidebar containing the main widget area
 *
 * @package mzd-recent-posts
 * @author CodexCoder
 */

/**
 * Add Recent Posts Widget Style One
 */
class Widget_Recent_Posts_One extends MZD_Custom_Widget {
    public function __construct() {
        parent::__construct(
                'Widget_Recent_Posts_One',	
                esc_html__( 'MZD ::: Recent Posts', 'mzd-recent-posts' ),	
                array( 'description' => __( 'Widgets to display recent posts style one', 'mzd-recent-posts' ) )	
        );
    }
	
    public function widget( $args, $instance ) {
        echo wp_kses_post($args['before_widget']);
        if( ! empty( $instance['title'] ) ) {
            echo wp_kses_post($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses_post($args['after_title']);
        }
        $latest_posts = new WP_Query( array(
            'post_type'		=> 'post',
            'posts_per_page'	=> $instance['limit'],
        ) );
        if( $latest_posts->have_posts() ) : ?>
		<style>
			.small-thumbnail {float: left; margin-right:20px;}.small-thumbnail img {width: 100px;height:auto;}.latest-news li {display:block;margin-bottom: 20px;list-style: none;}.latest-news .content .latest-news-title {font-size: 18px;color: #111111;display: block;font-family: 'Poppins', sans-serif;}.content .post-date{font-size: 14px;color: #111111;font-family: 'Poppins', sans-serif;}.latest-news .content{overflow: hidden;}
		</style>
        <ul class="latest-news">
        <?php while( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
            <li>
                <?php if( has_post_thumbnail() ) : ?>
					<div class="small-thumbnail">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
					</div>
				<?php endif; ?>
                <div class="content">
                    <a href="<?php the_permalink();?>" class="latest-news-title"><?php the_title();?></a>
                    <span class="post-date"><?php the_time('d F Y');?></span>
                </div>
            </li>
        <?php
        endwhile;
            wp_reset_postdata();
        ?>
        </ul>
<?php 
    endif;
    echo wp_kses_post($args['after_widget']);
}
	public function form( $instance ) {
			if (isset($instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}else {
				$title = __( 'Title goes here', 'mzd-recent-posts' );
			}
			if (isset($instance[ 'limit' ] ) ) {
				$limit = $instance[ 'limit' ];
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','mzd-recent-posts' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:','mzd-recent-posts' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>" />
		</p>
		<?php 
		}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['limit'] = $new_instance['limit'];
		return $instance;
	}
	
}
if ( !function_exists('mzd_widget_recent_posts_one')) {
    function mzd_widget_recent_posts_one() {
        register_widget( 'Widget_Recent_Posts_One' );
    }
    add_action( 'widgets_init', 'mzd_widget_recent_posts_one');
}