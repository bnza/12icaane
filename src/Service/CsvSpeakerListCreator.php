<?php

namespace App\Service;

use App\Repository\SpeakerRepository;
use League\Csv\Writer;

class CsvSpeakerListCreator
{
    /**
     * @var SpeakerRepository
     */
    private $repository;

    public function __construct(SpeakerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHeaders(): array
    {
        return [
            'id',
            'main_author',
            'other_authors',
            'title',
            'affiliation',
            'theme',
            'abstract',
            'payment_id',
            'remarks',
            'email',
            'created_at'
        ];
    }

    public function create(): string
    {
        $path = tempnam(sys_get_temp_dir(), '12icaane');
        $writer = Writer::createFromPath($path, 'w+');

        $writer->insertOne($this->getHeaders());
        foreach ($this->repository->findAllAsArray() as $row) {
            $row['created_at'] = $row['created_at']->format('Y-m-d H:i:s');
            $writer->insertOne($row);
        }

        return $path;
    }
}