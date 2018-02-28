<?php ?>
<html>
    <head>
        <title>HTML &amp; CSS tree</title>

        <!-- tree -->
        <style type="text/css">
            ul.tree {
                overflow-x: auto;
                white-space: nowrap;
            }
            ul.tree,
            ul.tree ul {
                width: auto;
                margin: 0;
                padding: 0;
                list-style-type: none;
            }
            ul.tree li {
                display: block;
                width: auto;
                float: left;
                vertical-align: top;
                padding: 0;
                margin: 0;
            }
            ul.tree ul li {
                background-image: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=);
                background-repeat: repeat-x;
                background-position: left top;
            }
            ul.tree li span {
                display: block;
                width: 5em;
                /*
                  uncomment to fix levels
                  height: 1.5em;
                */
                margin: 0 auto;
                text-align: center;
                white-space: normal;
                letter-spacing: normal;
            }
        </style>
        <!--[if IE gt 8]> IE 9+ and not IE -->
        <style type="text/css">
            ul.tree ul li:last-child {
                background-repeat: no-repeat;
                background-size:50% 1px;
                background-position: left top;
            }
            ul.tree ul li:first-child {
                background-repeat: no-repeat;
                background-size: 50% 1px;
                background-position: right top;
            }
            ul.tree ul li:first-child:last-child {
                background: none;
            }
            ul.tree ul li span {
                background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
                background-size: 1px 0.8em;
                padding-top: 1.2em;
            }
            ul.tree ul {
                background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
                background-size: 1px 0.8em;
                margin-top: 0.2ex;
                padding-top: 0.8em;
            }
        </style>
        <!-- <[endif]-->
        <!--[if lte IE 8]>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script type="text/javascript">
            /* Just to simplify HTML for the moment.
             * This could easily be replaced by inline classes.
             */
            $(function() {
              $('li:first-child').addClass('first');
              $('li:last-child').addClass('last');
              $('li:first-child:last-child').addClass('lone');
            });
        </script>
        <style type="text/css">
        ul.tree ul li {
          background-image: url(pixel.gif);
        }
        ul.tree ul li.first {
          background-image: url(left.gif);
          background-position: center top;
        }
        ul.tree ul li.last {
          background-image: url(right.gif);
          background-position: center top;
        }
        ul.tree ul li.lone {
          background: none;
        }
        ul.tree ul li span {
          background: url(child.gif) no-repeat 50% top;
          padding-top: 14px;
        }
        ul.tree ul {
          background: url(child.gif) no-repeat 50% top;
          margin-top: 0.2ex;
          padding-top: 11px;
        }
        </style>
        <[endif]-->

        <!-- page presentation -->
        <style type="text/css">
            body {
                font-family:sans-serif;
                color: #666;
                text-align: center;
            }
            A, A:visited, A:active {
                color: #c00;
                text-decoration: none;
            }

            A:hover {
                text-decoration: underline;
            }
            ul.tree,
            #wrapper {
                width: 960px;
                margin: 0 auto;
            }
            ul.tree {
                width: 650px;
            }
            .clearer {
                clear: both;
            }
            p {
                margin-top: 2em;
            }
        </style>
    </head>
    <body>
        <div id="wrapper" style="margin-top: 100px;">
            <h1 style="text-align: left;">Distributor ID : </h1>
            <ul class="tree">
                <li>
                    <span>Root</span>
                    <ul>
                        <li>
                            <span>Uncle</span>
                            <ul>
                                <li>
                                    <span>Cousin</span>
                                </li>
                                <li>
                                    <span>Cousin</span>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Aunt</span>
                            <ul>
                                <li>
                                    <span>Cousin</span>
                                </li>
                                <li>
                                    <span>Cousin</span>
                                </li>
                            </ul>
                        </li>
                </li>
            </ul>
            <div class="clearer"></div>
        </div>
    </body>
</html>