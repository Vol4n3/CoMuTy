<?php
namespace JCV\CommunityBundle\Twig;

use Twig_Extension;

class BBToHtml extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('bbtohtml',array($this,'parser'),array(
                'is_safe' => ['html']
            ))
        );
    }

    /**
     * @return string
     */
    public function getName(){
        return "bbtohtml";
    }

    /**
     * @param string $text
     * @return string
     */
    function parser(string $text){
        $tags = $this->getTags();
        for($i = 0; $i < count($tags); $i++)
        {
            $text = preg_replace_callback($tags[$i]['regex'],$tags[$i]['replace'],$text);
        }
        return $text;
    }

    /**
     * @return array
     */
    private function getTags(){
        return array(
            array(
                "regex" => "/</im",
                "replace" => function($res) {
                    return "&lt;";
                }
            ),
            array(
                "regex" => "/>/im",
                "replace" => function($res) {
                    return "&gt;";
                }
            ),
            array(
                "regex" => "/\[\/?br\/?\]/im",
                "replace" => function($res) {
                    return "<br>";
                }
            ),
            array(
                "regex" => "/\[youtube\=([-_a-z0-9]*)\]/im",
                "replace" => function($res) {
                    return '<div style="position: relative;">'
                        .'<img style="display: block;width: 100%;height: auto;" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7"/>'
                        .'<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="youtube" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/'
                        . $res[1] . '?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>'
                        .'</div>';
                }
            ),
            array(
                "regex" => "/\[soundcloud\=(https?\:\/\/[\-_a-z0-9.\/]*)\]/im",
                "replace" => function($res) {
                    return '<div style="position: relative;" >'
                        .'<img style="display: block;width: 100%;height: auto;" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7"/>'
                        .'<iframe  style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="youtube" type="text/html" src="https://w.soundcloud.com/player/?url='
                        . urlencode($res[1]) . '?&color=black_white&visual=true&show_comments=true&hide_related=true&show_reposts=false" frameborder="0" scrolling="no"></iframe>'
                        .'</div>';
                }
            ),
            array(
                "regex" => "/\[vimeo\=([-_a-z0-9]*)\]/im",
                "replace" => function($res) {
                    return '<div style="position: relative;">'
                        .'<img style="display: block;width: 100%;height: auto;" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7"/>'
                        .'<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="youtube" type="text/html" width="640" height="360" src="https://player.vimeo.com/video/'
                        . $res[1] . '?badge=0" frameborder="0" allowfullscreen></iframe>'
                        .'</div>';
                }
            ),
            array(
                "regex" => "/\[dailymotion\=([-_a-z0-9]*)\]/im",
                "replace" => function($res) {
                    return '<div style="position: relative;">'
                        .'<img style="display: block;width: 100%;height: auto;" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7"/>'
                        .'<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="dailymotion" type="text/html" width="640" height="360" '
                        .'src="http://www.dailymotion.com/embed/video/' . $res[1]
                        .'?endscreen-enable=false&ui-logo=false" frameborder="0" allowfullscreen></iframe>'
                        .'</div>';
                }
            ),
            array(
                "regex" => "/\[img=((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\]\s]+)[\a-z]*?(#[\w\-]+)?\]/im",
                "replace" => function($res) {
                    return '<img style="display: block; width: 100%;height: auto;" src="'.$res[2].'://'.$res[3].$res[4].$res[6].'">';
                }
            ),
            array(
                "regex" => "/\[wrap=([0-9]{1,3})\](.*?)\[\/wrap\]/im",
                "replace" => function($res) {
                    $number = intval($res[1]);
                    $number = $number > 100 ? $number = 100 : $number;
                    return '<div style="width:' . $number . '%;display:inline-block;vertical-align:middle;"> '. $res[2] . '</div>';
                }
            ),
            array(
                "regex" => "/\[color=([a-f0-9]{6})\](.*?)\[\/color\]/im",
                "replace" => function($res) {
                    return '<font color="' . $res[1] . '"> '. $res[2] . '</font>';
                }
            ),
            array(
                "regex" => "/\[font=([a-z0-9_\.\-\s])*\](.*?)\[\/font\]/im",
                "replace" => function($res) {
                    return '<font face="' . $res[1] . '"> '. $res[2] . '</font>';
                }
            ),
            array(
                "regex" => "/\[left\](.*?)\[\/left\]/im",
                "replace" => function($res) {
                    return '<div style="text-align:left;"> '. $res[1] . '</div>';
                }
            ),
            array(
                "regex" => "/\[right\](.*?)\[\/right\]/im",
                "replace" => function($res) {
                    return '<div style="text-align:right;"> '. $res[1] . '</div>';
                }
            ),
            array(
                "regex" => "/\[center\](.*?)\[\/center\]/im",
                "replace" => function($res) {
                    return '<div style="text-align:center;"> '. $res[1] . '</div>';
                }
            ),
            array(
                "regex" => "/\[h1\](.*?)\[\/h1\]/im",
                "replace" => function($res) {
                    return '<h1> '. $res[1] . '</h1>';
                }
            ),
            array(
                "regex" => "/\[h2\](.*?)\[\/h2\]/im",
                "replace" => function($res) {
                    return '<h2> '. $res[1] . '</h2>';
                }
            ),
            array(
                "regex" => "/\[h3\](.*?)\[\/h3\]/im",
                "replace" => function($res) {
                    return '<h3> '. $res[1] . '</h3>';
                }
            ),
            array(
                "regex" => "/\[h4\](.*?)\[\/h4\]/im",
                "replace" => function($res) {
                    return '<h4> '. $res[1] . '</h4>';
                }
            ),
            array(
                "regex" => "/\[h5\](.*?)\[\/h5\]/im",
                "replace" => function($res) {
                    return '<h5> '. $res[1] . '</h5>';
                }
            ),
            array(
                "regex" => "/\[h6\](.*?)\[\/h6\]/im",
                "replace" => function($res) {
                    return '<h6> '. $res[1] . '</h6>';
                }
            ),
        );
    }
}