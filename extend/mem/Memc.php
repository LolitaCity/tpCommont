<?php
/**
 * memcached 一致性hash测试
 *
 * @author  Lee<a605333742@gmail.com>
 * @date    2018-12-15
 */
namespace ext\mem;

class Memc {
    public $nodes= array();
    public $postion= array();
    public $mul= 32; //每个节点对应 32 个虚节点

    public function hash($str) {
        return sprintf('%u',crc32($str)); // 把字符串转成 32 位符号整数
    }
    //查找key落到那个节点上
    public function findNode($key) {
        $point= $this->hash($key);
        $node= current($this->postion); //先取圆环上最小的一个节点
        foreach($this->postion as $k=>$v) {
            if($point<= $k) {
                $node= $v;
                break;
            }
        }
        reset($this->postion);//复位数组指针
        return $node;//$key哈希后比最大的节点都大 就放到第一个节点
    }

    public function addNode($node) {
        if(isset($this->nodes[$node])) {
            return;
        }
        for($i=0; $i<$this->mul; $i++) {
            $pos= $this->hash($node. '-' . $i);//$node = '168.10.1.72:8888'
            $this->postion[$pos] = $node;
            $this->nodes[$node][] = $pos;//方便删除对应的虚拟节点
        }
        $this->sortPos();
    }

    public function delNode($node) {
        if(!isset($this->nodes[$node])) {
             return;
        }
        foreach($this->nodes[$node] as $k) {
            unset($this->postion[$k]);//删除对应的虚节点
        }
        unset($this->nodes[$node]);
    }

    public function sortPos() {
        ksort($this->postion,SORT_REGULAR);//SORT_REGULAR - 正常比较单元（不改变类型）
    }
}

