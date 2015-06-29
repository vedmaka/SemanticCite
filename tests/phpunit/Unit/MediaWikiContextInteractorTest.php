<?php

namespace SCI\Tests;

use SCI\MediaWikiContextInteractor;

/**
 * @covers \SCI\MediaWikiContextInteractor
 * @group semantic-cite
 *
 * @license GNU GPL v2+
 * @since   1.0
 *
 * @author mwjames
 */
class MediaWikiContextInteractorTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$context = $this->getMockBuilder( '\IContextSource' )
			->disableOriginalConstructor()
			->getMock();

		$this->assertInstanceOf(
			'\SCI\MediaWikiContextInteractor',
			new MediaWikiContextInteractor( $context )
		);
	}

	public function testHasAction() {

		$context = $this->getMockBuilder( '\IContextSource' )
			->disableOriginalConstructor()
			->getMock();

		$webRequest = $this->getMockBuilder( '\WebRequest' )
			->disableOriginalConstructor()
			->getMock();

		$webRequest->expects( $this->once() )
			->method( 'getVal' )
			->will( $this->returnValue( 'view' ) );

		$context->expects( $this->once() )
			->method( 'getRequest' )
			->will( $this->returnValue( $webRequest ) );

		$instance = new MediaWikiContextInteractor( $context );

		$this->assertTrue(
			$instance->hasAction( 'view' )
		);
	}

	public function testGetOldId() {

		$context = $this->getMockBuilder( '\IContextSource' )
			->disableOriginalConstructor()
			->getMock();

		$webRequest = $this->getMockBuilder( '\WebRequest' )
			->disableOriginalConstructor()
			->getMock();

		$context->expects( $this->any() )
			->method( 'getRequest' )
			->will( $this->returnValue( $webRequest ) );

		$context->expects( $this->any() )
			->method( 'getTitle' )
			->will( $this->returnValue( \Title::newFromText( __METHOD__ ) ) );

		$instance = new MediaWikiContextInteractor( $context );

		$this->assertInternalType(
			'integer',
			$instance->getOldId()
		);
	}

}