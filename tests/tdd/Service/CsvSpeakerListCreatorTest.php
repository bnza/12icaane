<?php
/**
 * Created by PhpStorm.
 * User: petrux
 * Date: 18/12/18
 * Time: 13.52
 */

namespace App\Tests\Service;


use PHPUnit\Framework\TestCase;
use App\Service\CsvSpeakerListCreator;
use App\Repository\SpeakerRepository;

class CsvSpeakerListCreatorTest extends TestCase
{
    public function testCreate()
    {
        $repository = $this->createMock(SpeakerRepository::class);
        $repository->method('findAllAsArray')->willReturn(
            [
                [
                    'id' => 1,
                    'main_author' => 'R. Smith',
                    'other_authors' => 'S. White, B. Mars',
                    'title' => 'Using Behat for Behaviour tests',
                    'affiliation' => 'University of Bologna',
                    'theme' => 1,
                    'abstract' => 'venenatis cras sed felis eget velit aliquet sagittis id consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper quis lectus nulla at volutpat diam ut venenatis tellus in metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel orci porta non pulvinar neque laoreet suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam non nisi est sit amet facilisis magna etiam tempor orci eu lobortis elementum nibh tellus molestie nunc non blandit massa enim nec dui nunc mattis enim ut tellus elementum sagittis vitae et leo duis ut diam quam nulla porttitor massa id',
                    'payment_id' => 'SWIFT-35453',
                    'remarks' => 'Registration remarks',
                    'email' => 'mail@example.net',
                    'created_at' => new \DateTime()
                ]
            ]
        );
        $creator = new CsvSpeakerListCreator($repository);
        $this->assertFileExists($creator->create());
    }
}