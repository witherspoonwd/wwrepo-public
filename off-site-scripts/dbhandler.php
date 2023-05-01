<?php
  require "/var/wwrepo/docs/php/databaseconnector.php"; // get database connection 

  // here is an attempt to "classify" the generation of ledgers for the website. this code is mostly unfinished.
  class indexDBHandler {
    private $selTab;
    private $prepStmt = "SELECT `:col` FROM :tab ORDER BY dateCreated DESC";

    private $itemNames;
    private $itemDates;
    private $itemHTMLs;
    private $itemViewBools;
    private $itemRecentBools;
    private $itemCategories;

    public function __construct($table) {
      $this->selTab = $table;
    }

    private function genDBarrays($nameCol, $dateCol, $htmlCol, $vBoolCol, $rBoolCol) {
      //===create item names array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$nameCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      //===create item dates array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$dateCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol`  ASC");
      $stmt->execute();
      $tempDateArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

      for ($i = 0; $i < count($tempDateArray); $i++) {
        $tempDateArray[$i] = strtotime("$tempDateArray[$i]");
      }

      $datesArrayObject = new ArrayObject($tempDateArray);
      $this->itemDates = $datesArrayObject->getArrayCopy();
      //======//

      unset($stmt); //delete le variable!

      //===create html file name array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$htmlCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemHTMLs = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      unset($stmt);

      //===create "isViewable" bool array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$vBoolCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemViewBools = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      unset($stmt);

      //===create "isRecent" bool array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$rBoolCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemRecentBools = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//
    }

    private function genDBarraysForMusic($nameCol, $dateCol, $htmlCol, $vBoolCol, $rBoolCol, $categoryCol) {
      //===create item names array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$nameCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      //===create item dates array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$dateCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol`  ASC");
      $stmt->execute();
      $tempDateArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

      for ($i = 0; $i < count($tempDateArray); $i++) {
        $tempDateArray[$i] = strtotime("$tempDateArray[$i]");
      }

      $datesArrayObject = new ArrayObject($tempDateArray);
      $this->itemDates = $datesArrayObject->getArrayCopy();
      //======//

      unset($stmt); //delete le variable!

      //===create html file name array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$htmlCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemHTMLs = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      unset($stmt);

      //===create "isViewable" bool array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$vBoolCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemViewBools = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      unset($stmt);

      //===create "isRecent" bool array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$rBoolCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemRecentBools = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      //===create "category" bool array===//
      $stmt = $GLOBALS['pdo']->prepare("SELECT `$categoryCol` FROM `$this->selTab` ORDER BY dateCreated DESC, `$nameCol` ASC");
      $stmt->execute();
      $this->itemCategories = $stmt->fetchAll(PDO::FETCH_COLUMN);
      //======//

      unset($stmt);
    }

    public function prepPublicSongsprint() {
      $this->genDBarraysForMusic("songTitle","dateCreated","htmlPath","isViewable","isRecent", "category");
    }

    public function prepPrivateMelodiesprint() {
      $this->genDBarrays("melodyTitle","dateCreated","htmlPath","isViewable","isRecent");
    }

    public function prepPrivateSessionsprint() {
      $this->genDBarrays("sessionTitle","dateCreated","htmlPath","isViewable","isRecent");
    }

    public function prepPublicFragmentsprint() {
      $this->genDBarrays("fragmentTitle","dateCreated","htmlPath","isViewable","isRecent");
    }

    public function printIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

        if ($this->itemViewBools[$i] == true){
          echo "<tr><td class=\"col-left\">";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td class=\"col-right\"><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";
        }
      }
    }

    public function printHiddenIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

          echo "<tr><td>";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";

      }
    }

    public function printSongsIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

        if ($this->itemViewBools[$i] == true && $this->itemCategories[$i] == "song"){
          echo "<tr><td class=\"col-left\">";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td class=\"col-right\"><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";
        }
      }
    }

    public function printSongCoverIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

        if ($this->itemViewBools[$i] == true && $this->itemCategories[$i] == "cover"){
          echo "<tr><td class=\"col-left\">";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td class=\"col-right\"><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";
        }
      }
    }

    public function printSongInstrumentalIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

        if ($this->itemViewBools[$i] == true && $this->itemCategories[$i] == "instrumental"){
          echo "<tr><td class=\"col-left\">";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td class=\"col-right\"><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";
        }
      }
    }

    public function printSongFragmentsIndex($linkRoot) {
      for ($i = 0; $i < count($this->itemNames); $i++){

        if ($this->itemViewBools[$i] == true && $this->itemCategories[$i] == "fragment"){
          echo "<tr><td class=\"col-left\">";
          echo date("m.d.y", $this->itemDates[$i]);
          echo "</td> <td class=\"col-right\"><a ";

          if ($this->itemRecentBools[$i] != 0) {
            echo "class=\"recentlyUpdated\" ";
          }

          echo "href=\"" . $linkRoot . $this->itemHTMLs[$i] . "\">";
          echo $this->itemNames[$i];
          echo "</a></td></tr>";
        }
      }
    }



  }

  /*
  AN EXAMPLE OF HOW TO RUN THIS CODE TO GENERATE A TABLE.
  $testIndex = new indexDBHandler("private_songs");
  $testIndex->prepPrivateSongsprint();
  $testIndex->printIndex("/private/songs/");
  */
?>
