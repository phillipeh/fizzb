<?php



namespace App\Service;

final class fbuzzService
{
    public function process(int $int1, int $int2, int $limit, string $str1, string $str2): array
    {
        $output = [];

		if($int1 > $int2) { 
			[$int1, $int2] = [$int2, $int1]; 
			[$str1, $str2] = [$str2, $str1];  
		}

		for ($i = 1; $i < $int1; $i++)  $output[] = (string) $i;
		$output[]=$str1;
		for ($i = $int1; $i < $int2; $i++)  $output[] = (string) $i;
		$output[]=$str2;

        for ($i = $int2; $i <= $limit; $i++) {
            $result = ''; 
            if ($i % $int1 == 0) {
                $result .= $str1;
            }
            if ($i % $int2 == 0) {
                $result .= $str2;
            }

            $output[] = $result !== '' ? $result : (string) $i;
        }

        return $output;
    }
}
