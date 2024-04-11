<?php
/**
 * Plugin Name: Coach Candace
 * Description: Avoir dans chaque onglet des vidéos explicatives. Un cadeau spécial pour mes appenants TITA.
 * Version: 1.0
 * Author: candacelissassi
 */


 function wp_add_video_tutorial() {
    global $pagenow;
    
    // Liste des pages d'aide contextuelle où nous voulons afficher les vidéos tutoriels.
    $allowed_pages = array( 
        'index.php' => 'https://www.youtube.com/embed/qutTKuqHi3I',
        'edit.php' => 'https://www.youtube.com/embed/8wf5tlr4VR8',
		'upload.php' => 'https://www.youtube.com/embed/WSpELBUXD3o',
        'edit-comments.php' => 'https://www.youtube.com/embed/4RcolO0CSyA',
        'themes.php' => 'https://www.youtube.com/embed/MMcRqe_4HTE',
        'nav-menus.php' => 'https://www.youtube.com/embed/O1a27twTBg4',
		'theme-editor.php' => 'https://www.youtube.com/embed/LvqPOLeQ3zY',
        'users.php' => 'https://www.youtube.com/embed/oUittervOU8',
        'tools.php' => 'https://www.youtube.com/embed/XD0SCPNDfIo',
		'options-general.php' => 'https://www.youtube.com/embed/23X2lA09mDA'
        // Ajouter d'autres pages et vidéos ici...
    );

    // Vérifie si la page courante est une page d'aide contextuelle autorisée.
    if ( in_array( $pagenow, array_keys( $allowed_pages ) ) ) {
        
        // Obtient l'ID de la page d'aide contextuelle.
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        // Vérifie si l'ID de la page d'aide contextuelle est valide.
        if ( !empty( $screen_id ) ) {
            
            // Obtient le titre de la page d'aide contextuelle.
            $title = $screen->get_help_tab( 'default' );
            //$title = $title['title'];

            // Obtient l'URL de la vidéo tutoriel correspondante pour cette page.
            $video_url = $allowed_pages[ $pagenow ];


            if ( $screen->id === 'edit-page' ) {
                $content = '<h3> Tutoriel vidéo : ' . $title . '</h3><iframe width="560" height="315" src="https://www.youtube.com/embed/w5t_-5JPkig" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
              } else {
                // Ajoute le contenu de la vidéo tutoriel à la page d'aide contextuelle.
			$content = '<h3> Tutoriel vidéo : ' . $title . '</h3><iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
              }
            

            $screen->add_help_tab( array(
                'id'      => 'wp_video_tutorial',
                'title'   => __( 'Coach Candace', 'wp_video_tutorial' ),
                'content' => $content,
            ) );
        }
    }
}
add_action( 'admin_head', 'wp_add_video_tutorial' );

?>