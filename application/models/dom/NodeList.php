<?php

/**
 * Operates on NodeList
 */
class Application_Model_Dom_NodeList
{
	/**
	 * Get node by tagname and class
	 * @param DOMNodeList $node Pointer to a node
	 * @param string $tagName Tag to search for
	 * @param string $class Class to search for
	 * @return DOMElement Found element
	 */
	public static function getElementByTagNameClass(DOMNodeList &$node, $tagName, $class)
	{
		$uls = $node->getElementsByTagName($tagName);
		foreach($uls as $ul)
		{
			if(preg_match("/^$class$|^$class\s|\s$class\s|\s$class$/", $ul->getAttribute('class')))
			{
				return $ul;
			}
		}
	}
}
