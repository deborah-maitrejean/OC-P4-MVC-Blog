<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/05/2018
 * Time: 10:00
 */

namespace Config;


class Routes
{
    public static $routes = array(
        // frontend:
        '#^$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        '#^home$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        '#^allPostsView$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts',
        ),
        '#^allPostsView&page=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts',
        ),
        '#^about$#' => array(
            'controller' => 'Frontend',
            'method' => 'aboutView'
        ),
        '#^contact$#' => array(
            'controller' => 'Frontend',
            'method' => 'contactView'
        ),
        '#^adminConnexion$#' => array(
            'controller' => 'Frontend',
            'method' => 'adminView'
        ),
        '#^listPosts$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts'
        ),
        '#^post$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^post&id=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^post&id=([0-9]+)&page=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^addComment&id=([0-9]+)&postTitle=([a-zA-Z0-9-_%éèâàôûï]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'addComment',
        ),
        '#^reportComment&commentId=([0-9]+)&reported=1&postId=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'reportComment',
        ),
        '#^cookies$#' => array(
            'controller' => 'Frontend',
            'method' => 'cookies'
        ),
        '#^legalesMentions$#' => array(
            'controller' => 'Frontend',
            'method' => 'legalesMentions'
        ),
        '#^404$#' => array(
            'controller' => 'Frontend',
            'method' => 'page404'
        ),
        // contact:
        '#^sendMail$#' => array(
            'controller' => 'Contact',
            'method' => 'sendMail'
        ),
        // login:
        '#^adminInterfaceLogin$#' => array(
            'controller' => 'Login',
            'method' => 'loginControl'
        ),
        '#^logOut$#' => array(
            'controller' => 'Login',
            'method' => 'logOut'
        ),
        '#^changePassword$#' => array(
            'controller' => 'Login',
            'method' => 'changePassword'
        ),
        '#^changeLogin$#' => array(
            'controller' => 'Login',
            'method' => 'changeLogin'
        ),
        // backend:
        '#^adminHomeView$#' => array(
            'controller' => 'Backend',
            'method' => 'adminHomeView'
        ),
        '#^postsManager$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^postsManager&page=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^postsManager&orderBy=date$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^newPost$#' => array(
            'controller' => 'Backend',
            'method' => 'newPostView'
        ),
        '#^publishPost$#' => array(
            'controller' => 'Backend',
            'method' => 'publishPost'
        ),
        '#^viewOrChangePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'viewOrChangePost',
        ),
        '#^updatePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'updatePost',
        ),
        '#^deletePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'deletePost',
        ),
        '#^commentsModeration$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^commentsModeration&orderBy=(date|posts)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^commentsModeration&page=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^moderateComment&commentId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentModeration',
        ),
        '#^editComment&commentId=([0-9]+)&reported=0$#' => array(
            'controller' => 'Backend',
            'method' => 'adminUpdateComment',
        ),
        '#^deleteComment&commentId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'deleteComment',
        ),
        '#^settings$#' => array(
            'controller' => 'Backend',
            'method' => 'settings'
        )
    );
}