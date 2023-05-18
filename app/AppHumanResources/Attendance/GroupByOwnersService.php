<?php
namespace App\AppHumanResources;

class GroupByOwnersService
{
    public function groupByOwners(array $files): array
    {
        $groupedFiles = [];

        foreach ($files as $file => $owner) {
            $groupedFiles[$owner][] = $file;
        }

        return $groupedFiles;
    }
}

// Test
$service = new GroupByOwnersService();

$files = [
    "insurance.txt" => "Company A",
    "letter.docx" => "Company A",
    "Contract.docx" => "Company B"
];

$result = $service->groupByOwners($files);

// Print the result
print_r($result);
