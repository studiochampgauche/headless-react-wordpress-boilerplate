<?php

    class helloChamp{

        function __construct(){
            
            if(!class_exists('scg')) return;
            
            /*
            * str_replace your return when you use scg::field(), StudioChampGauche\Utils\Field::get() or ACF REST API;
            */
            add_action('acf/init', function(){

                StudioChampGauche\Utils\Field::replace([
                    '{SITE_NAME}'
                ], [
                    StudioChampGauche\SEO\SEO::site_name()
                ]);

            });
            
            
            /*
            * Set defaults when you call scg::cpt() or StudioChampGauche\Utils\CustomPostType::get();
            */
            StudioChampGauche\Utils\CustomPostType::default('posts_per_page', -1);
            StudioChampGauche\Utils\CustomPostType::default('paged', 1);
            


            /*
            * Enqueue Scripts
            */
            add_action('wp_enqueue_scripts', function(){


                /*
                * Routes
                */

                $data = scg::cpt(['page', 'post'])->posts;
                $routes = [];

                if($data){

                    foreach ($data as $k => $v) {
                        
                        $acf = get_fields($v->ID);

                        $routes[] = [
                            'id' => $v->ID,
                            'routeName' => get_the_title($v->ID),
                            'path' => str_replace(site_url(), '', get_permalink($v->ID)),
                            'type' => $v->post_type,
                            'seo' => (isset($acf['seo']) ? $acf['seo'] : []),
                            'componentName' => (isset($acf['component_name']) && !empty($acf['component_name']) ? $acf['component_name'] : 'DefaultPage')
                        ];


                        $unset = [
                            'seo',
                            'component_name'
                        ];
                        
                        foreach($unset as $u){

                            if(isset($acf[$u])) unset($acf[$u]);

                        }

                        $routes[$k]['acf'] = $acf;


                        if($routes[$k]['type'] === 'post'){

                            $routes[$k]['componentName'] = 'SinglePostPage';
                            $routes[$k]['seo']['og_type'] = 'article';

                            $routes[$k]['extraDatas'] = [
                                'date' => $v->post_date,
                                'modified' => $v->post_modified,
                                'author' => get_author_posts_url($v->post_author)
                            ];

                        } elseif($routes[$k]['type'] === 'author'){

                            $routes[$k]['seo']['og_type'] = 'profile';

                            $routes[$k]['extraDatas'] = [
                                'username' => '',
                                'name' => [
                                    'firstname' => '',
                                    'lastname' => ''
                                ]
                            ];

                        }

                    }

                }
                wp_localize_script('scg-main', 'ROUTES', $routes);


                /*
                * medias
                *
                * $medias = [
                *     'home' => [
                *         [
                *             'type' => 'video',
                *             'target' => '',
                *             'src' => ''
                *         ],
                *         [
                *             'type' => 'image',
                *             'target' => '',
                *             'src' => ''
                *         ],
                *         [
                *             'type' => 'audio',
                *             'src' => ''
                *         ],
                *     ],
                *     'about' => [
                *         [
                *             'type' => 'video',
                *             'src' => ''
                *         ],
                *     ],
                * ];
                */

                $medias = [];

                wp_localize_script('scg-main', 'MEDIAS', $medias);
                
            });


            /*
            * Rest API Requests
            */
            $this->restRequests();



            /*
            * Ajax Requests
            */
            $this->ajaxRequests();

        }



        function restRequests(){


            add_action('rest_api_init', function(){

                /*
                *
                register_rest_route('scg/v1', '/custom/', [
                    'methods'  => 'GET',
                    'callback' => function(){

                        $data = [];

                        return new WP_REST_Response($data, 200);

                    },
                ]);
                */


            });

        }


        function ajaxRequests(){

            

        }

    }

    new helloChamp();
?>