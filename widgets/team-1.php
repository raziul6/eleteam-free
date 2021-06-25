<?php

class eleteamOne extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eleteam1';
    }

	public function get_title() {
		return esc_html__( 'Team Design One', 'eleteams' );
	}

	public function get_icon() {
		return 'fas fa-users';
	}

	public function get_categories() {
		return [ 'eleteams-category' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Team One Content', 'eleteams' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'team_photo',[
				'label' => esc_html__( 'Photo', 'eleteams' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'label_block' => true,
			]
		);	
        
        $this->add_control(
			'team_name',[
				'label' => esc_html__( 'Name', 'eleteams' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Ele Member Name', 'eleteams'),
                'label_block' => true,
			]
		);		
        $this->add_control(
			'team_job_title',[
				'label' => esc_html__( 'Job Title', 'eleteams' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Ele Office', 'eleteams'),
                'label_block' => true,
			]
		);	
        
		$this->end_controls_section();

        $this->start_controls_section(
			'_section_social',
			[
				'label' => esc_html__( 'Social Profile', 'eleteams' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'profile_name', [
				'label' => esc_html__( 'Profile Name', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'library' => 'solid',
					'value' => 'fab fa-twitter',
				],
			]
		);
        $repeater->add_control(
			'link', [
				'label' => esc_html__( 'Profile Link', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
                'autocomplete' => false,
				'show_external' => false,
			]
		);
        $repeater->add_control(
			'customize',
			[
				'label' => esc_html__( 'Change Style?', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'eleteams' ),
				'label_off' => esc_html__( 'No', 'eleteams' ),
				'return_value' => 'yes',
				'style_transfer' => true,
			]
		);
        $repeater->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes']
			]
		);
		$repeater->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'eleteams' ),
			]
		);
        $repeater->add_control(
			'color',
			[
				'label' => esc_html__( 'Text Color', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);
		$repeater->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Icon Background  Color', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile > {{CURRENT_ITEM}}' => 'background: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);
		
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => esc_html__( 'Normal', 'eleteams' ),
			]
		);
        $repeater->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile > {{CURRENT_ITEM}}:hover ' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);
		$repeater->add_control(
			'hover_bg_color',
			[
				'label' => esc_html__( 'Icon Hover Background', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile > {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);
        $this->add_control(
			'profiles',
			[
				'label' => __( 'Profile List', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'link' => ['url' => 'https://facebook.com/'],
						'profile_name'   => 'facebook',
					],
					[
						'link' => ['url' => 'https://twitter.com/'],
						'profile_name'   => 'twitter'
					],
					[
						'link' => ['url' => 'https://linkedin.com/'],
						'profile_name'   => 'linkedin'
					]
				],
				'title_field' => '{{{ profile_name }}}',
			]
		);
        $this->add_control(
			'show_profiles',
			[
				'label' => __( 'Show/Hide Profiles', 'eleteams' ),
				'type' =>  \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'eleteams' ),
				'label_off' => esc_html__( 'Hide', 'eleteams' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'style_transfer' => true,
			]
		);


        $this->end_controls_section();
		
		$this->start_controls_section(
			'style_section_photo',
			[
				'label' => esc_html__( 'Photo', 'eleteams' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'img_width',
			[
				'label' => esc_html__( 'Width', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 800,
						'step' => 4
					],
					'%' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-team-main-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_height',
			[
				'label' => esc_html__( 'Height', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 800,
						'step' => 4,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-team-main-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_spacing',
			[
				'label' => esc_html__( 'Photo Bottom Spacing', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .eltm-team-main-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_border_radious',
			[
				'label' => esc_html__( 'Border Radius', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eltm-team-main-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'style_section_title',
			[
				'label' => esc_html__( 'Name,Job Title', 'eleteams' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Content Alignment', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'eleteams' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'eleteams' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'eleteams' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
		
		$this->add_control(
			'_heading_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Name', 'eleteams' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'eleteams' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eltm-team-body h4',
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Name Color', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-team-body h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'_heading_job_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Job Title', 'eleteams' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'label' => esc_html__( 'Typography', 'eleteams' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eltm-team-body p',
			]
		);
		$this->add_control(
			'job_title_color',
			[
				'label' => esc_html__( 'Job Title Color', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eltm-team-body p' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->end_controls_section();

		$this->start_controls_section(
			'style_section_social',
			[
				'label' => esc_html__( 'Social Profile', 'eleteams' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Alignment', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'eleteams' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'eleteams' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'eleteams' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'Width', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 32,
						'max' => 100,
						'step' => 2
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__( 'Height', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 32,
						'max' => 100,
						'step' => 2
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_lineheight',
			[
				'label' => esc_html__( 'Line Height', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 32,
						'max' => 100,
						'step' => 2
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'icon_font_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'eleteams' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 100,
						'step' => 2
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eltm-social-profile a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() { 
        $team_photo  = $this->get_settings_for_display( 'team_photo' );
        $team_name   = $this->get_settings_for_display( 'team_name' );
        $job_title   = $this->get_settings_for_display( 'team_job_title' );
        $profiles    = $this->get_settings_for_display( 'profiles' );
        $show_profiles    = $this->get_settings_for_display( 'show_profiles' );
        $text_align    = $this->get_settings_for_display( 'text_align' );
        $icon_align    = $this->get_settings_for_display( 'icon_align' );
        ?>
            <div class="eltm-team-box">
                <div class="eltm-team-img">
                    <div class="eltm-team-main-img">
						<img src="<?php echo esc_url($team_photo['url']);?>" alt="<?php echo esc_attr($team_name);?>">
					</div>
                    <?php if($show_profiles):?>
						<div class="eltm-social-profile <?php echo esc_attr($icon_align);?>">
							<?php 
							foreach($profiles as $profile):
								$icon = $profile['icon'];
								$url = $profile['link']['url'];
							?>
							<a target="_blank" rel="noopener" href="<?php echo esc_url($url);?>" class="elementor-repeater-item-<?php echo esc_attr($profile['_id']);?>"><?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?></a>
							<?php 
							endforeach;
							?>
						</div>
					<?php endif;?>
                </div>
                <div class="eltm-team-body <?php echo esc_attr($text_align);?>">
                    <h4><?php echo esc_html($team_name);?></h4>
                    <p><?php echo esc_html($job_title);?></p>
                </div>
            </div>
        <?php
	}

}
