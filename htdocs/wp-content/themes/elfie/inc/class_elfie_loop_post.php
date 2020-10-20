<?php
/**
 * Class to handle post items on all types of archives
 *
 * @package Elfie
 */


if ( !class_exists( 'Elfie_Post_Item' ) ) :

	/**
	 * Elfie_Post_Item 
	 */
	Class Elfie_Post_Item {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {		
			add_action( 'elfie_post_item_content', array( $this, 'render_post_elements' ) );
			add_filter( 'excerpt_more', array( $this, 'read_more_link' ) );
		}

		/**
		 * Build post item
		 */
		public function render_post_elements( $layout_type ) {

			$elements = get_theme_mod( 'post_item_elements', $this->get_default_elements() );

			if ( 'is-list' === $layout_type ) {
				$elements = array_diff( $elements, array( 'loop_image' ) );
			}

			foreach( $elements as $element ) {
				call_user_func( array( $this, $element ), $layout_type );
			}
		}

		/**
		 * Default elements for the post item
		 */
		public function get_default_elements() {
			return array( 'loop_category', 'loop_post_title', 'loop_post_meta', 'loop_image', 'loop_post_excerpt' );
		}

		/**
		 * Post element: image
		 */
		public function loop_image() {

			if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
				return;
			}

			$blog_layout = $this -> blog_layout();
						
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				if ( 'layout-3cols' !== $blog_layout && 'layout-2cols-sb' !== $blog_layout ) {
					the_post_thumbnail( 'elfie-900x9999', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
				} else {
					the_post_thumbnail( 'elfie-400x9999', array( //Smaller image for the grid modes
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );					
				}
				?>
			</a>
			<?php
		}

		/**
		 * Post element: title
		 */
		public function loop_post_title() {
			?>
			<header class="entry-header post-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->
			<?php
		}	
		
		/**
		 * Post element: first category
		 */
		public function loop_category() {
			?>
			<div class="post-cats"><?php elfie_first_category(); ?></div>
			<?php
		}	
		
		/**
		 * Post element: meta
		 */
		public function loop_post_meta() {
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					elfie_posted_by();
					elfie_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif;
		}	
		
		/**
		 * Post element: excerpt
		 */
		public function loop_post_excerpt( $layout_type ) {

			$full_content = get_theme_mod( 'show_full_content', 0 );
			$blog_layout  = $this -> blog_layout();
			?>
			<div class="entry-content">
				<?php
				$more = '';

				if ( $full_content && 'layout-classic' == $blog_layout ) {
					the_content(); 
				} else {
					if ( has_excerpt() ) {
						the_excerpt(); 
						echo $this->read_more_link( $more );
					} else {
						if ( 'is-large' !== $layout_type ) {
							the_excerpt(); 
						} else {
							echo wp_trim_words( get_the_content(), '35', $this->read_more_link( $more ) );
						}
					}
	
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elfie' ),
						'after'  => '</div>',
					) );
				}
				?>
			</div><!-- .entry-content -->
			<?php
		}

		/**
		 * Build read more link with user defined text
		 */
		public function read_more_link( $more ) {

			if ( is_admin() ) {
				return $more;
			}

			$text = get_theme_mod( 'read_more_text', esc_html__( 'Continue reading', 'elfie' ) );
			
			$link =  '<a class="read-more" href="'. esc_url( get_permalink() ) . '"/>' . esc_html( $text ) . '</a>';

			return $link;
		}

		/**
		 * Blog layout
		 */
		public function blog_layout() {
			$blog_layout = get_theme_mod( 'blog_layout', 'layout-mixed' );

			return $blog_layout;
		}
	}

	/**
	 * Initialize class
	 */
	Elfie_Post_Item::get_instance();

endif;