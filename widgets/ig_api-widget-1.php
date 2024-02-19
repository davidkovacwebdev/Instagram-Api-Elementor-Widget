<?php
class Elementor_Ig_Feed_Widget extends \Elementor\Widget_Base {

	static $data;

	public function get_name() {

		return 'ig_api_feed';
	}

	public function fetch_data($token){
		$url = 'https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type,username,timestamp,permalink&access_token='.$token;
		$string_json_data = file_get_contents($url);
		$json_data = json_decode($string_json_data);


		if (isset($json_data->data) && !empty($json_data->data)) {
			$data = $json_data->data;
		}
		return $data;
	}

	public function get_style_depends() {
		return [ 'widget-style-1' ];
	}

	public function get_title() {
		return esc_html__( 'Simple IG Feed', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'instagram', 'instagram' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_token',
			[
				'label' => esc_html__( 'Token', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'token',
			[
				'label' => esc_html__( 'Enter your token here', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Example: "HZMrK8vZ5ZkVdByZidNrl1xAM6qauo2W2ml7qSw5oHM5E84O5CckNwkqVufs"', 'elementor-addon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Manage Content', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'include_captions',
			[
				'label' => esc_html__( 'Include Captions', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'include_videos',
			[
				'label' => esc_html__( 'Include Videos', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'include_links',
			[
				'label' => esc_html__( 'Enable links', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'include_date',
			[
				'label' => esc_html__( 'Enable Date', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'date_format',
			[
				'label' => esc_html__( 'Enter your token here', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Y-m-h', 'elementor-addon' ),
				'condition' => [
					'include_date' => 'yes',
				],
			]
		);
		$this->add_control(
			'include_username',
			[
				'label' => esc_html__( 'Enable Username', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'include_by',
			[
				'label' => esc_html__( 'Toggle "By" next to Username', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'=>[
					'include_username'=>'yes',
				]
			]
		);


		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'style_text',
			[
				'label' => esc_html__( 'Basic Text Styling', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .your-caption' => 'color: {{VALUE}}',
				],
				'default'=> '#000',
			]
		);
		$this->add_control(
			'username_color',
			[
				'label' => esc_html__( 'Username color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .feed_username' => 'color: {{VALUE}}',
					'{{WRAPPER}} .feed_username a' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Date color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .post-date' => 'color: {{VALUE}}',

				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style_structure',
			[
				'label' => esc_html__( 'Basic Structure and feed Styling', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'column_number',
			[
				'label' => esc_html__( 'Column number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
			]
			
		);
		
		
		$this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .instagram-feed-feed_list li img' => 'border-radius: {{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->add_control(
			'equalize_posts',
			[
				'label' => esc_html__( 'Limit post heights', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .instagram-feed-feed_list.equal-posts li' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'equalize_posts'=>'yes',
				]
			]
		);
		


		

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$data = $this->fetch_data($settings['token']);
	
		$column_number = $settings['column_number'];
		$widthPercentages = [1 => 99.5, 2 => 49, 3 => 32, 4 => 24, 5 => 19.5];
		$widthPercentage = $widthPercentages[$column_number] ?? 99.5;
	
		?>
		<div id="instagram_feed" class="instagram_feed">
			<?php if ($settings['include_username'] == 'yes'): ?>
				<h2 class="feed_username">
					<?php if ($settings['include_by'] == 'yes'): ?>
						<span class="feed_username_by">By</span>
					<?php endif; ?>
					<a href="<?= $data[0]->permalink ?>"><?= $data[0]->username ?></a>
				</h2>
			<?php endif; ?>
			<ul class="instagram-feed-feed_list <?= $settings['equalize_posts'] == 'yes' ? 'equal-posts' : '' ?>">
				<?php
				if (isset($data)) {
					foreach ($data as $item) {
						$media_url = $item->media_url;
						$media_type = $item->media_type;
						$permalink = $item->permalink;
						$post_date = $item->timestamp;
						$caption = isset($item->caption) ? $item->caption : "No caption";
						?>
						<?php if ($media_type == 'IMAGE'): ?>
							<li class="single-feed-item item-image" style="width: <?= $widthPercentage ?>%;">
								<a href="<?= $permalink ?>">
									<img src="<?= $media_url ?>">
									<?php if ($settings['include_captions'] == 'yes'): ?>
										<span class="your-caption"><?= $caption ?></span>
									<?php endif; ?>
									<?php if ($settings['include_date'] == "yes"): ?>
										<span class="post-date"><?= date($settings['date_format'], strtotime($post_date)) ?></span>
									<?php endif; ?>
								</a>
							</li>
						<?php elseif ($media_type == "VIDEO" && $settings['include_videos'] == 'yes'): ?>
							<li class="single-feed-item your item-video" style="width: <?= $widthPercentage ?>%;">
								<a href="<?= $permalink ?>">
									<video class="instagram_video" width="100%" height="100%" controls>
										<source src="<?= $media_url ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>
									<?php if ($settings['include_captions'] == 'yes'): ?>
										<span class="your-caption"><?= $caption ?></span>
									<?php endif; ?>
									<?php if ($settings['include_date'] == "yes"): ?>
										<span class="post-date"><?= date($settings['date_format'], strtotime($post_date)) ?></span>
									<?php endif; ?>
								</a>
							</li>
						<?php endif; ?>
						<?php
					}
				} else {
					echo "No data found.\n";
				}
				?>
			</ul>
		</div>
		<?php
	}
	
	
}