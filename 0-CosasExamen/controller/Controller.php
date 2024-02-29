<?php



abstract class Controller
{
    protected string $strPageTitle;
    protected string $strView;
    protected array $arrParams;

    public function getPageTitle(): string
    {
        return $this->strPageTitle;
    }

    public function getView(): string
    {
        return $this->strView;
    }

    protected function paginateData(int $intTotalRegisters, string $strSelectedPage): array
    {
        $arrReturn = [];

        $intSelectedPage = (int)$strSelectedPage;

        if (isset($_POST['numRegisters'])) {
            $_SESSION['numRegisters'] = $_POST['numRegisters'];
        }

        $numberRegisters = $_SESSION['numRegisters'] ?? DEFAULT_REGISTERS;

        $arrReturn['totalRegisters'] = $intTotalRegisters;

        $maxPage = ceil($intTotalRegisters / $numberRegisters);
        $arrReturn['maxPage'] = $maxPage;

        if ($intSelectedPage <= 1) {
            $intSelectedPage = 1;
        } elseif ($intSelectedPage > $maxPage) {
            $intSelectedPage = $maxPage;
        }

        $arrReturn['selectedPage'] = $intSelectedPage;

        return $arrReturn;
    }
}