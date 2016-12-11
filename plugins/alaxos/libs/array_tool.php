<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class ArrayTool
{
    /**
     * Return an array containing a subgroup of the $array_pairs pairs
     *
     * @param $array_keys An array containing the keys to keep of the second array
     * @param $array_pairs An array of keys-values pairs to filter
     * @return array
     */
    public static function intersect_value_key($array_keys, $array_pairs)
    {
        $key_key_array = array();
        foreach($array_keys as $key)
        {
            $key_key_array[$key] = $key;
        }
        
        return array_intersect_key($array_pairs, $key_key_array);
    }
}
?>