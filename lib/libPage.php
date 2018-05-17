<?php

//require 'libDB.php';
//SERVER
function serverDatatable() {
    try {
        $rsServer = selectAllServer();
        foreach ($rsServer as $row) {
            $table = "<tr class=\"gradeA\">";
            $table.="<td>$row[name]</td>";
            $table.="<td>$row[ip]</td>";
            $table.="<td>$row[description]</td>";

            $rsWorkServer = selectWorkServerDatatable($row[idserver]);
            foreach ($rsWorkServer as $rowCount) {
                $table.="<td class=\"center\">$rowCount[count]</td>";
            }
            $table.="<td class=\"center\">"
                    //. "<button id=\"btnOptionsCopyServer-$row[idserver]\" class=\"btn btn-warning bt btnOptionsCopyServer\" data-toggle=\"modal\" data-target=\"#copyServer\" value=\"cop-$row[idserver]\">Copy</button>"
                    . "<button id=\"btnOptionsDeleteServer-$row[idserver]\" class=\"btn btn-danger bt btnOptionsDeleteServer\" data-toggle=\"modal\" data-target=\"#deleteServer\" value=\"del-$row[idserver]\">Delete</button>"
                    . "</td>";
            $table.="</tr>";
            echo $table;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

//WORK
function workDatatable() {
    try {
        $rsWork = selectAllWork();
        foreach ($rsWork as $row) {
            $table = "<tr class=\"gradeX\">";
            $table.="<td>$row[identify]</td>";

            $rsWorkServerName = selectWorkServerName($row[server_idserver]);
            foreach ($rsWorkServerName as $rowWorkServerName) {
                $table.="<td class=\"center\">$rowWorkServerName[name]</td>";
            }

            $table.="<td>$row[user]</td>";

            $rsWorkBackupType = selectWorkBackupTypeName($row[backupType_idbackupType]);
            foreach ($rsWorkBackupType as $rowWorkBackupType) {
                $table.="<td class=\"center\">$rowWorkBackupType[type]</td>";
            }

            $table.="<td class=\"center\" >"
                    . "<button id=\"btnOptionsUpdateWork-$row[idwork]\" class=\"btn btn-info bt btnOptionsUpdateWork\" data-toggle=\"modal\" data-target=\"#updateWork\" value=\"upd-$row[idwork]\">Edit</button>"
                    . "<button id=\"btnOptionsDeleteWork-$row[idwork]\" class=\"btn btn-danger bt btnOptionsDeleteWork\" data-toggle=\"modal\" data-target=\"#deleteWork\" value=\"del-$row[idwork]\">Delete</button>"
                    . "</td>";
            $table.="</tr>";
            echo $table;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

function cmbNewWorkServer() {
    try {
        $rsServer = selectAllServer();
        foreach ($rsServer as $row) {
            echo "<option value=\"$row[idserver]\">$row[name]</option>";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function cmbNewWorkType() {
    try {
        $rsBackupType = selectAllBackupType();
        foreach ($rsBackupType as $row) {
            echo "<option value=\"$row[idbackupType]\">$row[type]</option>";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//LOG
function logDatatable() {
    try {
        $rsLog = selectAllLog();
        foreach ($rsLog as $row) {
            $table = "<tr class=\"gradeA\">";
            $table.="<td>" . selectWorkIdentifyByID($row[work_idwork]) . "</td>";

            switch ($row[status]) {
                case "0":
                    $logStatus = "Success";
                    break;
                case "1":
                    $logStatus = "Error";
                    break;
                case "2":
                    $logStatus = "Warning";
                    break;
                case "3":
                    $logStatus = "Info";
                    break;
                default:
                    $logStatus = "Unknown";
                    break;
            }

            $table.="<td>$logStatus</td>";

            $table.="<td>$row[dateandtime]</td>";
            $table.="<td>$row[log]</td>";
            echo $table;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

//BACKUP
function getBackupTime($file, $datetime) {
    if ($datetime === "" || $datetime === null || $datetime === " ") {
        return "Running";
    } else {
        $fileExplode = explode("-", $file);
        $fileExplodeYear = substr($fileExplode[0], 0, 4);
        $fileExplodeMonth = substr($fileExplode[0], 4, 2);
        $fileExplodeDay = substr($fileExplode[0], 6, 2);
        ;
        $fileExplodeDate = $fileExplodeYear . "-" . $fileExplodeMonth . "-" . $fileExplodeDay;
        $fileExplodeHour = $fileExplode[1] . ":" . $fileExplode[2];
        $fileFinalDateAndTime = $fileExplodeDate . " " . $fileExplodeHour;

        $to_time = strtotime($datetime);
        $from_time = strtotime($fileFinalDateAndTime);
        $timeDifference = round(abs($to_time - $from_time) / 60, 2) . " minutes";

        $timeDifferenceMinutesArray = explode(".", $timeDifference);
        $timeDifferenceMinutes = $timeDifferenceMinutesArray[0];
        $timeDifferenceSeconds = explode(":", $datetime);

        $timeDifferenceFinal = $timeDifferenceMinutes . "m and " . $timeDifferenceSeconds[2] . "s";
        return $timeDifferenceFinal;
    }
}

function backupDatatable($idserver) {
    try {
        //echo "Chegou: $idserver";
        $rsBackupByServer = selectBackupByServerID($idserver);
        foreach ($rsBackupByServer as $row) {
            $idwork = $row['work_idwork'];
            $table.="<tr class=\"gradeA\">";
            $table.="<td>" . selectWorkIdentifyByID($row['work_idwork']) . "</td>";
            $table.="<td>" . selectServerNameByID($idserver) . "</td>";
            $table.="<td>$row[dateandtime]</td>";
            $table.="<td>" . getBackupTime($row[file], $row[dateandtime]) . "</td>";

            $filename = "https://" . $_SERVER['SERVER_NAME'] . "/backups/" . $idserver . "/" . $idwork . "/" . $row[file];

            if ($row[status] == 0) {
                $table.="<td><a href=\"$filename\">$row[file]<a></td>";
            }
            if ($row[status] == 1) {
                $table.="<td>Removed by retention</td>";
            }

            /* $table.="<td class=\"center\" >"
              . "<button id=\"btnOptionsDeleteWork-$row[idwork]\" class=\"btn btn-danger bt btnOptionsDeleteWork\" data-toggle=\"modal\" data-target=\"#deleteWork\" value=\"del-$row[idwork]\">Delete</button>"
              . "</td>"; */
        }
        echo $table;
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}

function cmbBackupServer() {
    try {
        $rsServer = selectAllServer();
        foreach ($rsServer as $row) {
            echo "<option value=\"bkp-$row[idserver]\">$row[name]</option>";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

//DASHBOARD
function dashGetTotalSpace($directory) {
    $space = disk_total_space($directory);
    return $space;
}

function dashGetFreeSpace($directory) {
    $space = disk_free_space($directory);
    return $space;
}

function dashCalculateFreePercent($directory) {
    $totalDiskSpace = dashGetTotalSpace($directory);
    $freeDiskSpace = dashGetFreeSpace($directory);
    $differenceDisk = $totalDiskSpace - $freeDiskSpace;
    $percentageDisk = sprintf('%.2f', ($differenceDisk / $totalDiskSpace) * 100);
    $percentageDisk = $percentageDisk - 4;
    return $percentageDisk;
}

function dashGetMemory() {
    $memAvailable = explode(":", preg_replace('/\s+/', '', shell_exec('cat /proc/meminfo | grep MemAvailable:')));
    $memTotal = explode(":", preg_replace('/\s+/', '', shell_exec('cat /proc/meminfo | grep MemTotal:')));

    $memAvailableClean = preg_replace('/kB/', '', $memAvailable[1]);
    $memTotalClean = preg_replace('/kB/', '', $memTotal[1]);

    $memoryFree = $memTotalClean - $memAvailableClean;

    $percentageMemory = sprintf('%.2f', ($memoryFree / $memTotalClean) * 100);
    return $percentageMemory;
}

function dashGetLoad() {
    if (!function_exists("sys_getloadavg")) {
        return $load[0] = "0";
    } else {
        $load = sys_getloadavg();
        return $load[0];
    }
}

function dashGetCPU() {
    $cpuIdle = explode(",", preg_replace('/\s+/', '', shell_exec('top -b -n 1 | grep -A 5 "%Cpu" | head -n 1')));
    $cpuIdleClean = preg_replace('/id/', '', $cpuIdle[3]);
    $cpuUse = 100 - $cpuIdleClean;
    $cpuUse = round($cpuUse, 2);
    return $cpuUse;
}

function dashGetTotalMessage() {
    $totalLogMessage = getTotalLogMessages();
    return $totalLogMessage;
}

function dashGetTotalErrors() {
    $totalLogMessage = getErrorsLogMessages();
    return $totalLogMessage;
}

function dashGetTotalSuccess() {
    $totalLogMessage = getSuccessLogMessages();
    return $totalLogMessage;
}

function dashGetTotalWarning() {
    $totalLogMessage = getWarningLogMessages();
    return $totalLogMessage;
}

function dashGetTotalUnknown() {
    $totalLogMessage = getUnknownLogMessages();
    return $totalLogMessage;
}

function dashGetTotalInfo() {
    $totalLogMessage = getInfoLogMessages();
    return $totalLogMessage;
}

function dashGetTotalErrorsPercent() {
    $totalLogMessage = dashGetTotalMessage();
    $totalErrors = dashGetTotalErrors();

    $percent = ($totalErrors * 100) / $totalLogMessage;
    $percent = round($percent, 1);
    return $percent;
}

function dashGetTotalSuccessPercent() {
    $totalLogMessage = dashGetTotalMessage();
    $totalSuccesss = dashGetTotalSuccess();

    $percent = ($totalSuccesss * 100) / $totalLogMessage;
    $percent = round($percent, 1);
    return $percent;
}

function dashGetTotalWarningPercent() {
    $totalLogMessage = dashGetTotalMessage();
    $totalWarning = dashGetTotalWarning();

    $percent = ($totalWarning * 100) / $totalLogMessage;
    $percent = round($percent, 1);
    return $percent;
}

function dashGetTotalUnknownPercent() {
    $totalLogMessage = dashGetTotalMessage();
    $totalUnknown = dashGetTotalUnknown();

    $percent = ($totalUnknown * 100) / $totalLogMessage;
    $percent = round($percent, 1);
    return $percent;
}

function dashGetTotalInfoPercent() {
    $totalLogMessage = dashGetTotalMessage();
    $totalInfo = dashGetTotalUnknown();

    $percent = ($totalInfo * 100) / $totalLogMessage;
    $percent = round($percent, 1);
    return $percent;
}

function dashCalcPercent($total, $value) {
    $percent = ($value * 100) / $total;
    $percent = round($percent, 1);
    return $percent;
}

function dashServerErrorBar() {
    try {
        $rsServerErrorCount = getErrorsCountLogMessages();
        $totalErrors = getErrorsLogMessages();

        foreach ($rsServerErrorCount as $row) {

            $serverName = selectServerNameByID($row[0]);
            $errorCount = $row[1];
            $errorBarPercent = dashCalcPercent($totalErrors, $errorCount);

            $bars = "<b>$serverName</b>";
            $bars.="<div class=\"progress\">";
            $bars.= "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $errorBarPercent%;\">";
            $bars.= "<span>$errorCount - $errorBarPercent%</span>";
            $bars.= "</div>";
            $bars.="</div>";

            echo $bars;
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

?>