<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head) {
        $list = $head;
        $endList = $list;
        $listValues = [];
        
        if ($list == null) {
            return $list;
        }
        
        while($endList != null) {
            $listValues[] = $endList->val;
            $endList = $endList->next;
        }
        
        $listSize = count($listValues);
        $middleList = floor($listSize / 2);
        
        
        
        $listValues = array_slice($listValues, $middleList);
        
        $list2 = new ListNode();
        $endList2 = $list2;
        
        for ($i = 0; $i < count($listValues); $i++) {
            $endList2->val = $listValues[$i];
            
            if ($i < count($listValues) - 1) {
                $endList2->next = new ListNode();
                $endList2 = $endList2->next;
            }
        }
        
        return $list2;
    }
}