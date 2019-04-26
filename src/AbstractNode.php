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
 * Main dom node class.
 */
abstract class AbstractNode {

	/**
	 * Child nodes container.
	 *
	 * @var array
	 */
	protected $childNodes = [];

	/**
	 * Indentation.
	 *
	 * @var string
	 */
	protected $indent = null;

	/**
	 * Dom output.
	 *
	 * @var string
	 */
	protected $output = null;

	/**
	 * Parent node.
	 *
	 * @var AbstractNode
	 */
	protected $parent = null;

	/**
	 * Get indentation.
	 *
	 * @return string
	 */
	public function getIndent() {
		return $this->indent;
	}

	/**
	 * Set indentation.
	 *
	 * @param  string $indent indentation level.
	 * @return mixed
	 */
	public function setIndent( $indent ) {
		$this->indent = $indent;
		return $this;
	}

	/**
	 * Retrieve the parent node.
	 *
	 * @return AbstractNode
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Set a parent node.
	 *
	 * @param  AbstractNode $parent the parent node.
	 * @return AbstractNode
	 */
	public function setParent( AbstractNode $parent ) {
		$this->parent = $parent;
		return $this;
	}

	/**
	 * Add a child node to a given node.
	 *
	 * @param  mixed $c the child node.
	 * @throws \InvalidArgumentException
	 * @return mixed
	 */
	public function addChild( Child $c ) {
		$c->setParent( $this );
		$this->childNodes[] = $c;
		return $this;
	}

	/**
	 * Add children to the objet.
	 *
	 * @param  $children items to add.
	 * @throws Exception When not assigning the correct object.
	 * @return mixed
	 */
	public function addChildren( $children ) {
		if ( is_array( $children ) ) {
			foreach ( $children as $child ) {
				$this->addChild( $child );
			}
		} elseif ( $children instanceof Child ) {
			$this->addChild( $children );
		} else {
			throw new Exception( 'Error: Must be an instance of PNO\Dom\Child.' );
		}
		return $this;
	}

	/**
	 * Determin if child nodes has objects.
	 *
	 * @return boolean
	 */
	public function hasChildren() {
		return ( count( $this->childNodes ) > 0 );
	}

	/**
	 * Determin if child nodes has objects. (alias)
	 *
	 * @return boolean
	 */
	public function hasChildNodes() {
		return ( count( $this->childNodes ) > 0 );
	}

	/**
	 * Get the child nodes of the object.
	 *
	 * @param int $i index.
	 * @return Child
	 */
	public function getChild( $i ) {
		return ( isset( $this->childNodes[ (int) $i ] ) ) ? $this->childNodes[ (int) $i ] : null;
	}

	/**
	 * Get the child nodes of the object.
	 *
	 * @return array
	 */
	public function getChildren() {
		return $this->childNodes;
	}

	/**
	 * Get the child nodes of the object (alias).
	 *
	 * @return array
	 */
	public function getChildNodes() {
		return $this->childNodes;
	}

	/**
	 * Remove all child nodes from the object.
	 *
	 * @param  int $i index of the element.
	 * @return void
	 */
	public function removeChild( $i ) {
		if ( isset( $this->childNodes[ $i ] ) ) {
			unset( $this->childNodes[ $i ] );
		}
	}

	/**
	 * Remove all child nodes from the object.
	 *
	 * @return void
	 */
	public function removeChildren() {
		$this->childNodes = [];
	}
}
