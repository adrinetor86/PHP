<?php



class Book
{
    private string $strTable;
    private PDO $PDOConnection;

    public function __construct()
    {
        $this->strTable = 'LIBROS';
        $this->PDOConnection = Database::createConn();
    }

    public function getTotalBooksBySearch(): int
    {
        $SQLQuery = 'SELECT COUNT(*) AS CANTIDAD'
            . ' FROM LIBROS';

        $PDOStmt = $this->PDOConnection->prepare($SQLQuery);

        $PDOStmt->execute();
        $totalBooksRow = $PDOStmt->fetch(PDO::FETCH_ASSOC);

        return $totalBooksRow['CANTIDAD'];
    }

    public function getItems(array $arrParams): array
    {
        $strPage = $arrParams[0];

        $intRegisters = $_SESSION['numRegisters'] ?? DEFAULT_REGISTERS;
        $intLimit = ((int)$strPage - 1) * $intRegisters;

        $SQLQuery =
            'SELECT * FROM LIBROS'
            . ' ORDER BY TITULO'
            . ' LIMIT ' . $intLimit . ', ' . $intRegisters;


        $PDOStmt = $this->PDOConnection->prepare($SQLQuery);

        $PDOStmt->execute();
        $count = $this->getTotalBooksBySearch();
        $results = $PDOStmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'count' => $count,
            'results' => $results
        ];
    }
}