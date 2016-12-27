<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('e_utf8', array($this, 'e_utf8Filter')),
        );
    }


    public function e_utf8Filter($str)
    {
        $pos = strpos ( $str ,"value" );
        if($pos === false )
        {

        }
        else
        {
            $nova_string= substr ( $str , 0,$pos);
            
            $last= strrpos ($str ,'"');
            $value = "";
            for($i=$pos+7;$i<$last;$i++)
            {
                switch (bin2hex($str[$i])){
                    case "80":
                        $value.='€';
                        break;
                    case "81":
                        $value.='';
                        break;
                    case "82":
                        $value.='‚';
                        break;
                    case "83":
                        $value.='ƒ';
                        break;
                    case "84":
                        $value.='„';
                        break;
                    case "85":
                        $value.='…';
                        break;
                    case "86":
                        $value.='†';
                        break;
                    case "87":
                        $value.='‡';
                        break;
                    case "88":
                        $value.='ˆ';
                        break;
                    case "89":
                        $value.='‰';
                        break;
                    case "8a":
                        $value.='Š';
                        break;
                    case "8b":
                        $value.='‹';
                        break;
                    case "8c":
                        $value.='Œ';
                        break;
                    case "8d":
                        $value.='';
                        break;
                    case "8e":
                        $value.='Ž';
                        break;
                    case "8f":
                        $value.='';
                        break;
                    case "90":
                        $value.='';
                        break;
                    case "91":
                        $value.='‘';
                        break;
                    case "92":
                        $value.='’';
                        break;
                    case "93":
                        $value.='“';
                        break;
                    case "94":
                        $value.='”';
                        break;
                    case "95":
                        $value.='•';
                        break;
                    case "96":
                        $value.='–';
                        break;
                    case "97":
                        $value.='—';
                        break;
                    case "98":
                        $value.='˜';
                        break;
                    case "99":
                        $value.='™';
                        break;
                    case "9a":
                        $value.='š';
                        break;
                    case "9b":
                        $value.='›';
                        break;
                    case "9c":
                        $value.='œ';
                        break;
                    case "9d":
                        $value.='';
                        break;
                    case "9e":
                        $value.='ž';
                        break;
                    case "9f":
                        $value.='Ÿ';
                        break;
                    case "a0":
                        $value.='';
                        break;
                    case "a1":
                        $value.='¡';
                        break;
                    case "a2":
                        $value.='¢';
                        break;
                    case "a3":
                        $value.='£';
                        break;
                    case "a4":
                        $value.='¤';
                        break;
                    case "a5":
                        $value.='¥';
                        break;
                    case "a6":
                        $value.='¦';
                        break;
                    case "a7":
                        $value.='§';
                        break;
                    case "a8":
                        $value.='¨';
                        break;
                    case "a9":
                        $value.='©';
                        break;
                    case "aa":
                        $value.='ª';
                        break;
                    case "ab":
                        $value.='«';
                        break;
                    case "ac":
                        $value.='¬';
                        break;
                    case "ad":
                        $value.='';
                        break;
                    case "ae":
                        $value.='®';
                        break;
                    case "af":
                        $value.='¯';
                        break;
                    case "b0":
                        $value.='°';
                        break;
                    case "b1":
                        $value.='±';
                        break;
                    case "b2":
                        $value.='²';
                        break;
                    case "b3":
                        $value.='³';
                        break;
                    case "b4":
                        $value.='´';
                        break;
                    case "b5":
                        $value.='µ';
                        break;
                    case "b6":
                        $value.='¶';
                        break;
                    case "b7":
                        $value.='·';
                        break;
                    case "b8":
                        $value.='¸';
                        break;
                    case "b9":
                        $value.='¹';
                        break;
                    case "ba":
                        $value.='º';
                        break;
                    case "bb":
                        $value.='»';
                        break;
                    case "bc":
                        $value.='¼';
                        break;
                    case "bd":
                        $value.='½';
                        break;
                    case "be":
                        $value.='¾';
                        break;
                    case "bf":
                        $value.='¿';
                        break;
                    case "c0":
                        $value.='À';
                        break;
                    case "c1":
                        $value.='Á';
                        break;
                    case "c2":
                        $value.='Â';
                        break;
                    case "c3":
                        $value.='Ã';
                        break;
                    case "c4":
                        $value.='Ä';
                        break;
                    case "c5":
                        $value.='Å';
                        break;
                    case "c6":
                        $value.='Æ';
                        break;
                    case "c7":
                        $value.='Ç';
                        break;
                    case "c8":
                        $value.='È';
                        break;
                    case "c9":
                        $value.='É';
                        break;
                    case "ca":
                        $value.='Ê';
                        break;
                    case "cb":
                        $value.='Ë';
                        break;
                    case "cc":
                        $value.='Ì';
                        break;
                    case "cd":
                        $value.='Í';
                        break;
                    case "ce":
                        $value.='Î';
                        break;
                    case "cf":
                        $value.='Ï';
                        break;
                    case "d0":
                        $value.='Ð';
                        break;
                    case "d1":
                        $value.='Ñ';
                        break;
                    case "d2":
                        $value.='Ò';
                        break;
                    case "d3":
                        $value.='Ó';
                        break;
                    case "d4":
                        $value.='Ô';
                        break;
                    case "d5":
                        $value.='Õ';
                        break;
                    case "d6":
                        $value.='Ö';
                        break;
                    case "d7":
                        $value.='×';
                        break;
                    case "d8":
                        $value.='Ø';
                        break;
                    case "d9":
                        $value.='Ù';
                        break;
                    case "da":
                        $value.='Ú';
                        break;
                    case "db":
                        $value.='Û';
                        break;
                    case "dc":
                        $value.='Ü';
                        break;
                    case "dd":
                        $value.='Ý';
                        break;
                    case "de":
                        $value.='Þ';
                        break;
                    case "df":
                        $value.='ß';
                        break;
                    case "e0":
                        $value.='à';
                        break;
                    case "e1":
                        $value.='á';
                        break;
                    case "e2":
                        $value.='â';
                        break;
                    case "e3":
                        $value.='ã';
                        break;
                    case "e4":
                        $value.='ä';
                        break;
                    case "e5":
                        $value.='å';
                        break;
                    case "e6":
                        $value.='æ';
                        break;
                    case "e7":
                        $value.='ç';
                        break;
                    case "e8":
                        $value.='è';
                        break;
                    case "e9":
                        $value.='é';
                        break;
                    case "ea":
                        $value.='ê';
                        break;
                    case "eb":
                        $value.='ë';
                        break;
                    case "ec":
                        $value.='ì';
                        break;
                    case "ed":
                        $value.='í';
                        break;
                    case "ee":
                        $value.='î';
                        break;
                    case "ef":
                        $value.='ï';
                        break;
                    case "f0":
                        $value.='ð';
                        break;
                    case "f1":
                        $value.='ñ';
                        break;
                    case "f2":
                        $value.='ò';
                        break;
                    case "f3":
                        $value.='ó';
                        break;
                    case "f4":
                        $value.='ô';
                        break;
                    case "f5":
                        $value.='õ';
                        break;
                    case "f6":
                        $value.='ö';
                        break;
                    case "f7":
                        $value.='÷';
                        break;
                    case "f8":
                        $value.='ø';
                        break;
                    case "f9":
                        $value.='ù';
                        break;
                    case "fa":
                        $value.='ú';
                        break;
                    case "fb":
                        $value.='û';
                        break;
                    case "fc":
                        $value.='ü';
                        break;
                    case "fd":
                        $value.='ý';
                        break;
                    case "fe":
                        $value.='þ';
                        break;
                    case "ff":
                        $value.='v';
                        break;
                    default:
                        $value .= $str[$i];
                        break;

                }

                //var_dump(bin2hex($str[$i]));
            }
            $value = mb_convert_encoding($value, "UTF-8", mb_detect_encoding($value, "UTF-8, ISO-8859-1, ISO-8859-15", true));
            //$nova_string .= $value ;
            return $nova_string . 'value="'. $value .'">';
        }
        return $str;
    }
    /*
        public function getFunctions()
        {
            return array(
                new \Twig_SimpleFunction('palavrautf8', array($this, 'palavrautf8')),
            );
        }


        public function palavrautf8($value)
        {

            $value_displayed = $value."MMMMM";


            return $value_displayed ;
        }*/
    


public function getName()
{
return 'app_extension';
}
}