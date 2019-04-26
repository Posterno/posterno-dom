<?php
/**
 * Component for generating, rendering and parsing DOM elements.
 *
 * @package     posterno
 * @copyright   Copyright (c) 2009-2019, NOLA Interactive, LLC.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1.0
 */

/**
 * @namespace
 */
namespace PNO\Dom;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Helper class to iterate between dom nodes.
 */
class DomIterator implements \RecursiveIterator {

	/**
	 * Current position.
	 *
	 * @var int
	 */
	protected $position;

	/**
	 * Node List.
	 *
	 * @var \DOMNodeList
	 */
	protected $nodeList;

	/**
	 * Get things started
	 *
	 * @param \DOMNode $domNode the node to iterate.
	 */
	public function __construct( \DOMNode $domNode ) {
		$this->position = 0;
		$this->nodeList = $domNode->childNodes;
	}

	/**
	 * Get current method.
	 *
	 * @return \DOMElement
	 */
	public function current() {
		return $this->nodeList->item( $this->position );
	}

	/**
	 * Get children method.
	 *
	 * @return DomIterator
	 */
	public function getChildren() {
		return new self( $this->current() );
	}

	/**
	 * Has children method.
	 *
	 * @return bool
	 */
	public function hasChildren() {
		return $this->current()->hasChildNodes();
	}

	/**
	 * Key method.
	 *
	 * @return int
	 */
	public function key() {
		return $this->position;
	}

	/**
	 * Next method.
	 */
	public function next() {
		$this->position++;
	}

	/**
	 * Rewind method.
	 */
	public function rewind() {
		$this->position = 0;
	}

	/**
	 * Is valid method.
	 *
	 * @return bool
	 */
	public function valid() {
		return $this->position < $this->nodeList->length;
	}

}
