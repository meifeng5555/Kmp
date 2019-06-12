<?php
final class Kmp
{
    /**
     * 最长前缀后缀数组
     * @var array
     */
    private $next;

    private $value;

    public function __construct(string $source, string $need)
    {
        $this->value = $this->getNext($need)->getIndex($source, $need);
    }

    /**
     * 得到next数组
     */
    private function getNext($need)
    {
        // 初始化第一个子串，-1表示不存在相同的最大前缀和最大后缀
        $this->next[0] = -1;

        // 初始化值
        $k = -1;

        // 字符串长度
        $len = strlen($need);

        for ($i = 1; $i < $len; $i++) {

            while ($k > -1 && $need[$k + 1] != $need[$i]) {
                $k = $this->next[$k];
            }

            if ($need[$k + 1] == $need[$i]) {
                $k++;
            }

            $this->next[$i] = $k;
        }

        return $this;
    }

    /**
     * 获得匹配串在父串中的索引值
     */
    private function getIndex($source, $need)
    {
        $k = -1;
        $len = strlen($source);
        $nlen = strlen($need);

        for ($i = 0; $i < $len; $i++) {
            
            while ($k > -1 && $need[$k + 1] != $source[$i]) {
                $k = $this->next[$k];
            }

            if ($need[$k + 1] == $source[$i]) {
                $k++;
            }

            if ($k == $nlen - 1) {
                return $i - $nlen + 1;
            }
        }

        return -1;
    }

    public function getValue()
    {
        return $this->value;
    }
}

function kmp($source, $need)
{
    return (new kmp($source, $need))->getValue();
}