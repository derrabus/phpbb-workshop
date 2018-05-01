<?php

namespace App\View;

class BBEncoder
{
    public function encode($message, $isHtmlDisabled)
    {
        // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
        // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
        $message = ' '.$message;

        // First: If there isn't a "[" and a "]" in the message, don't bother.
        if (!(strpos($message, '[') && strpos($message, ']'))) {
            // Remove padding, return.
            $message = substr($message, 1);

            return $message;
        }

        // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
        $message = $this->encodeCode($message, $isHtmlDisabled);

        // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
        $message = $this->encodeQuote($message);

        // [list] and [list=x] for (un)ordered lists.
        $message = $this->encodeList($message);

        // [b] and [/b] for bolding text.
        $message = preg_replace("/\[b\](.*?)\[\/b\]/si", '<!-- BBCode Start --><B>\\1</B><!-- BBCode End -->', $message);

        // [i] and [/i] for italicizing text.
        $message = preg_replace("/\[i\](.*?)\[\/i\]/si", '<!-- BBCode Start --><I>\\1</I><!-- BBCode End -->', $message);

        // [img]image_url_here[/img] code..
        $message = preg_replace("/\[img\](.*?)\[\/img\]/si", '<!-- BBCode Start --><IMG SRC="\\1" BORDER="0"><!-- BBCode End -->', $message);

        // Patterns and replacements for URL and email tags..
        $patterns = [];
        $replacements = [];

        // [url]xxxx://www.phpbb.com[/url] code..
        $patterns[0] = "#\[url\]([a-z]+?://){1}(.*?)\[/url\]#si";
        $replacements[0] = '<!-- BBCode u1 Start --><A HREF="\1\2" TARGET="_blank">\1\2</A><!-- BBCode u1 End -->';

        // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
        $patterns[1] = "#\[url\](.*?)\[/url\]#si";
        $replacements[1] = '<!-- BBCode u1 Start --><A HREF="http://\1" TARGET="_blank">\1</A><!-- BBCode u1 End -->';

        // [url=xxxx://www.phpbb.com]phpBB[/url] code..
        $patterns[2] = "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si";
        $replacements[2] = '<!-- BBCode u2 Start --><A HREF="\1\2" TARGET="_blank">\3</A><!-- BBCode u2 End -->';

        // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
        $patterns[3] = "#\[url=(.*?)\](.*?)\[/url\]#si";
        $replacements[3] = '<!-- BBCode u2 Start --><A HREF="http://\1" TARGET="_blank">\2</A><!-- BBCode u2 End -->';

        // [email]user@domain.tld[/email] code..
        $patterns[4] = "#\[email\](.*?)\[/email\]#si";
        $replacements[4] = '<!-- BBCode Start --><A HREF="mailto:\1">\1</A><!-- BBCode End -->';

        $message = preg_replace($patterns, $replacements, $message);

        // Remove our padding from the string..
        $message = substr($message, 1);

        return $message;
    }

    public function decode($message)
    {
        // Undo [code]
        $code_start_html = '<!-- BBCode Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Code:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><PRE>';
        $code_end_html = '</PRE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode End -->';
        $message = str_replace($code_start_html, '[code]', $message);
        $message = str_replace($code_end_html, '[/code]', $message);

        // Undo [quote]
        $quote_start_html = '<!-- BBCode Quote Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Quote:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><BLOCKQUOTE>';
        $quote_end_html = '</BLOCKQUOTE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode Quote End -->';
        $message = str_replace($quote_start_html, '[quote]', $message);
        $message = str_replace($quote_end_html, '[/quote]', $message);

        // Undo [b] and [i]
        $message = preg_replace('#<!-- BBCode Start --><B>(.*?)</B><!-- BBCode End -->#s', '[b]\\1[/b]', $message);
        $message = preg_replace('#<!-- BBCode Start --><I>(.*?)</I><!-- BBCode End -->#s', '[i]\\1[/i]', $message);

        // Undo [url] (long form)
        $message = preg_replace('#<!-- BBCode u2 Start --><A HREF="([a-z]+?://)(.*?)" TARGET="_blank">(.*?)</A><!-- BBCode u2 End -->#s', '[url=\\1\\2]\\3[/url]', $message);

        // Undo [url] (short form)
        $message = preg_replace('#<!-- BBCode u1 Start --><A HREF="([a-z]+?://)(.*?)" TARGET="_blank">(.*?)</A><!-- BBCode u1 End -->#s', '[url]\\3[/url]', $message);

        // Undo [email]
        $message = preg_replace('#<!-- BBCode Start --><A HREF="mailto:(.*?)">(.*?)</A><!-- BBCode End -->#s', '[email]\\1[/email]', $message);

        // Undo [img]
        $message = preg_replace('#<!-- BBCode Start --><IMG SRC="(.*?)" BORDER="0"><!-- BBCode End -->#s', '[img]\\1[/img]', $message);

        // Undo lists (unordered/ordered)

        // <li> tags:
        $message = str_replace('<!-- BBCode --><LI>', '[*]', $message);

        // [list] tags:
        $message = str_replace('<!-- BBCode ulist Start --><UL>', '[list]', $message);

        // [list=x] tags:
        $message = preg_replace('#<!-- BBCode olist Start --><OL TYPE=([A1])>#si', '[list=\\1]', $message);

        // [/list] tags:
        $message = str_replace('</UL><!-- BBCode ulist End -->', '[/list]', $message);
        $message = str_replace('</OL><!-- BBCode olist End -->', '[/list]', $message);

        return $message;
    }

    /**
     * Nathan Codding - Jan. 12, 2001.
     * Performs [quote][/quote] bbencoding on the given string, and returns the results.
     * Any unmatched "[quote]" or "[/quote]" token will just be left alone.
     * This works fine with both having more than one quote in a message, and with nested quotes.
     * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
     *
     * Note: This function assumes the first character of $message is a space, which is added by
     * bbencode().
     */
    private function encodeQuote($message)
    {
        // First things first: If there aren't any "[quote]" strings in the message, we don't
        // need to process it at all.

        if (!strpos(strtolower($message), '[quote]')) {
            return $message;
        }

        $stack = [];
        $curr_pos = 1;
        while ($curr_pos && ($curr_pos < strlen($message))) {
            $curr_pos = strpos($message, '[', $curr_pos);

            // If not found, $curr_pos will be 0, and the loop will end.
            if ($curr_pos) {
                // We found a [. It starts at $curr_pos.
                // check if it's a starting or ending quote tag.
                $possible_start = substr($message, $curr_pos, 7);
                $possible_end = substr($message, $curr_pos, 8);
                if (0 == strcasecmp('[quote]', $possible_start)) {
                    // We have a starting quote tag.
                    // Push its position on to the stack, and then keep going to the right.
                    $this->arrayPush($stack, $curr_pos);
                    ++$curr_pos;
                } elseif (0 == strcasecmp('[/quote]', $possible_end)) {
                    // We have an ending quote tag.
                    // Check if we've already found a matching starting tag.
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        // We need to do 2 replacements now.
                        $start_index = $this->arrayPop($stack);

                        // everything before the [quote] tag.
                        $before_start_tag = substr($message, 0, $start_index);

                        // everything after the [quote] tag, but before the [/quote] tag.
                        $between_tags = substr($message, $start_index + 7, $curr_pos - $start_index - 7);

                        // everything after the [/quote] tag.
                        $after_end_tag = substr($message, $curr_pos + 8);

                        $message = $before_start_tag.'<!-- BBCode Quote Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Quote:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><BLOCKQUOTE>';
                        $message .= $between_tags.'</BLOCKQUOTE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode Quote End -->';
                        $message .= $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (sizeof($stack) > 0) {
                            $curr_pos = $this->arrayPop($stack);
                            $this->arrayPush($stack, $curr_pos);
                            ++$curr_pos;
                        } else {
                            $curr_pos = 1;
                        }
                    } else {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                } else {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        } // while

        return $message;
    }

    /**
     * Nathan Codding - Jan. 12, 2001.
     * Performs [code][/code] bbencoding on the given string, and returns the results.
     * Any unmatched "[code]" or "[/code]" token will just be left alone.
     * This works fine with both having more than one code block in a message, and with nested code blocks.
     * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
     *
     * Note: This function assumes the first character of $message is a space, which is added by
     * bbencode().
     */
    private function encodeCode($message, $isHtmlDisabled)
    {
        // First things first: If there aren't any "[code]" strings in the message, we don't
        // need to process it at all.
        if (!strpos(strtolower($message), '[code]')) {
            return $message;
        }

        // Second things second: we have to watch out for stuff like [1code] or [/code1] in the
        // input.. So escape them to [#1code] or [/code#1] for now:
        $message = preg_replace("/\[([0-9]+?)code\]/si", '[#\\1code]', $message);
        $message = preg_replace("/\[\/code([0-9]+?)\]/si", '[/code#\\1]', $message);

        $stack = [];
        $curr_pos = 1;
        $max_nesting_depth = 0;
        while ($curr_pos && ($curr_pos < strlen($message))) {
            $curr_pos = strpos($message, '[', $curr_pos);

            // If not found, $curr_pos will be 0, and the loop will end.
            if ($curr_pos) {
                // We found a [. It starts at $curr_pos.
                // check if it's a starting or ending code tag.
                $possible_start = substr($message, $curr_pos, 6);
                $possible_end = substr($message, $curr_pos, 7);
                if (0 == strcasecmp('[code]', $possible_start)) {
                    // We have a starting code tag.
                    // Push its position on to the stack, and then keep going to the right.
                    $this->arrayPush($stack, $curr_pos);
                    ++$curr_pos;
                } elseif (0 == strcasecmp('[/code]', $possible_end)) {
                    // We have an ending code tag.
                    // Check if we've already found a matching starting tag.
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        $curr_nesting_depth = sizeof($stack);
                        $max_nesting_depth = ($curr_nesting_depth > $max_nesting_depth) ? $curr_nesting_depth : $max_nesting_depth;

                        // We need to do 2 replacements now.
                        $start_index = $this->arrayPop($stack);

                        // everything before the [code] tag.
                        $before_start_tag = substr($message, 0, $start_index);

                        // everything after the [code] tag, but before the [/code] tag.
                        $between_tags = substr($message, $start_index + 6, $curr_pos - $start_index - 6);

                        // everything after the [/code] tag.
                        $after_end_tag = substr($message, $curr_pos + 7);

                        $message = $before_start_tag.'['.$curr_nesting_depth.'code]';
                        $message .= $between_tags.'[/code'.$curr_nesting_depth.']';
                        $message .= $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (sizeof($stack) > 0) {
                            $curr_pos = $this->arrayPop($stack);
                            $this->arrayPush($stack, $curr_pos);
                            ++$curr_pos;
                        } else {
                            $curr_pos = 1;
                        }
                    } else {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                } else {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        } // while

        if ($max_nesting_depth > 0) {
            for ($i = 1; $i <= $max_nesting_depth; ++$i) {
                $start_tag = $this->escapeSlashes(preg_quote('['.$i.'code]'));
                $end_tag = $this->escapeSlashes(preg_quote('[/code'.$i.']'));

                $match_count = preg_match_all("/$start_tag(.*?)$end_tag/si", $message, $matches);

                for ($j = 0; $j < $match_count; ++$j) {
                    $before_replace = $this->escapeSlashes(preg_quote($matches[1][$j]));
                    $after_replace = $matches[1][$j];

                    if (($i < 2) && !$isHtmlDisabled) {
                        // don't escape special chars when we're nested, 'cause it was already done
                        // at the lower level..
                        // also, don't escape them if HTML is disabled in this post. it'll already be done
                        // by the posting routines.
                        $after_replace = htmlspecialchars($after_replace);
                    }

                    $str_to_match = $start_tag.$before_replace.$end_tag;

                    $message = preg_replace("/$str_to_match/si", "<!-- BBCode Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Code:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><PRE>$after_replace</PRE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode End -->", $message);
                }
            }
        }

        // Undo our escaping from "second things second" above..
        $message = preg_replace("/\[#([0-9]+?)code\]/si", '[\\1code]', $message);
        $message = preg_replace("/\[\/code#([0-9]+?)\]/si", '[/code\\1]', $message);

        return $message;
    }

    /**
     * Nathan Codding - Jan. 12, 2001.
     * Performs [list][/list] and [list=?][/list] bbencoding on the given string, and returns the results.
     * Any unmatched "[list]" or "[/list]" token will just be left alone.
     * This works fine with both having more than one list in a message, and with nested lists.
     * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
     *
     * Note: This function assumes the first character of $message is a space, which is added by
     * bbencode().
     */
    private function encodeList($message)
    {
        $start_length = [];
        $start_length['ordered'] = 8;
        $start_length['unordered'] = 6;

        // First things first: If there aren't any "[list" strings in the message, we don't
        // need to process it at all.

        if (!strpos(strtolower($message), '[list')) {
            return $message;
        }

        $stack = [];
        $curr_pos = 1;
        while ($curr_pos && ($curr_pos < strlen($message))) {
            $curr_pos = strpos($message, '[', $curr_pos);

            // If not found, $curr_pos will be 0, and the loop will end.
            if ($curr_pos) {
                // We found a [. It starts at $curr_pos.
                // check if it's a starting or ending list tag.
                $possible_ordered_start = substr($message, $curr_pos, $start_length['ordered']);
                $possible_unordered_start = substr($message, $curr_pos, $start_length['unordered']);
                $possible_end = substr($message, $curr_pos, 7);
                if (0 == strcasecmp('[list]', $possible_unordered_start)) {
                    // We have a starting unordered list tag.
                    // Push its position on to the stack, and then keep going to the right.
                    $this->arrayPush($stack, [$curr_pos, '']);
                    ++$curr_pos;
                } elseif (preg_match("/\[list=([a1])\]/si", $possible_ordered_start, $matches)) {
                    // We have a starting ordered list tag.
                    // Push its position on to the stack, and the starting char onto the start
                    // char stack, the keep going to the right.
                    $this->arrayPush($stack, [$curr_pos, $matches[1]]);
                    ++$curr_pos;
                } elseif (0 == strcasecmp('[/list]', $possible_end)) {
                    // We have an ending list tag.
                    // Check if we've already found a matching starting tag.
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        // We need to do 2 replacements now.
                        $start = $this->arrayPop($stack);
                        $start_index = $start[0];
                        $start_char = $start[1];
                        $is_ordered = ('' != $start_char);
                        $start_tag_length = ($is_ordered) ? $start_length['ordered'] : $start_length['unordered'];

                        // everything before the [list] tag.
                        $before_start_tag = substr($message, 0, $start_index);

                        // everything after the [list] tag, but before the [/list] tag.
                        $between_tags = substr($message, $start_index + $start_tag_length, $curr_pos - $start_index - $start_tag_length);
                        // Need to replace [*] with <LI> inside the list.
                        $between_tags = str_replace('[*]', '<!-- BBCode --><LI>', $between_tags);

                        // everything after the [/list] tag.
                        $after_end_tag = substr($message, $curr_pos + 7);

                        if ($is_ordered) {
                            $message = $before_start_tag.'<!-- BBCode olist Start --><OL TYPE='.$start_char.'>';
                            $message .= $between_tags.'</OL><!-- BBCode olist End -->';
                        } else {
                            $message = $before_start_tag.'<!-- BBCode ulist Start --><UL>';
                            $message .= $between_tags.'</UL><!-- BBCode ulist End -->';
                        }

                        $message .= $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (sizeof($stack) > 0) {
                            $a = $this->arrayPop($stack);
                            $curr_pos = $a[0];
                            $this->arrayPush($stack, $a);
                            ++$curr_pos;
                        } else {
                            $curr_pos = 1;
                        }
                    } else {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                } else {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        } // while

        return $message;
    }

    /**
     * James Atkinson - Feb 5, 2001
     * This function does exactly what the PHP4 function array_push() does
     * however, to keep phpBB compatable with PHP 3 we had to come up with out own
     * method of doing it.
     */
    private function arrayPush(&$stack, $value)
    {
        $stack[] = $value;

        return sizeof($stack);
    }

    /**
     * James Atkinson - Feb 5, 2001
     * This function does exactly what the PHP4 function array_pop() does
     * however, to keep phpBB compatable with PHP 3 we had to come up with out own
     * method of doing it.
     */
    private function arrayPop(&$stack)
    {
        $arrSize = count($stack);
        $x = 1;
        $tmpArr = [];
        while (list($key, $val) = each($stack)) {
            if ($x < count($stack)) {
                $tmpArr[] = $val;
            } else {
                $return_val = $val;
            }
            ++$x;
        }
        $stack = $tmpArr;

        return $return_val;
    }

    /**
     * Nathan Codding - Oct. 30, 2000.
     *
     * Escapes the "/" character with "\/". This is useful when you need
     * to stick a runtime string into a PREG regexp that is being delimited
     * with slashes.
     */
    public function escapeSlashes($input)
    {
        $output = str_replace('/', '\/', $input);

        return $output;
    }
}
