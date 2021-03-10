<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 6:43 AM
 */


namespace App\DataSeparator;


class DataSeparator
{
    private array $tickets;
    private array $instruments;
    private array $statuses;
    private array $types;

    public function __construct(private array $data)
    {
        $this->separate();
    }

    /**
     *
     */
    private function separate(): void
    {
        $header = array();

        foreach ($this->data as $key => $row) {
            $row_elem = [];
            foreach ($row as $field_key => $field) {
                if ($key === 0) {
                    /** if first row */
                    $header[$field_key] = $field;
                } else {
                    /** tickets array row reformat (header_key=>field_value)*/
                    $row_elem[$header[$field_key]] = $field;

                }
            }
            if (count($row_elem)) {
                /** tickets array build */
                $this->tickets[] = $row_elem;

                /** instruments array build */
                $this->buildInstrumentsArray($row_elem['Instrument_Name']);


            }

        }
    }

    /**
     * @param string $instrument_string
     */
    private function buildInstrumentsArray(string $instrument_string): void
    {
        if (preg_match('/[A-Z]{6}/', $instrument_string)) {
            $this->instruments[$instrument_string] = 0;
        }
    }

    public function getTickets(): array
    {
        return $this->tickets;
    }

    public function getInstruments(): array
    {
        return $this->instruments;
    }

    public function getStatuses(): array
    {

    }

    public function getTypes(): array
    {

    }
}
