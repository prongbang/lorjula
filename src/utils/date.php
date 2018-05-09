<?php

/**
 * Description of DateUtil
 *
 * @author xE4
 */
class DateUtil {

    public static function timestamp() {
        $date = new DateTime();
        return $date->getTimestamp();
    }

}
