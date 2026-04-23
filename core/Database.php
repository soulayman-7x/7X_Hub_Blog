<?php
require_once 'config.php';
class Database
{
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // man3 browsers alwahmiya 
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            $timestamp = date('Y-m-d H:i:s');
            $log_message = "[{$timestamp}] X_Core_SYSTEM_ERROR: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../core_err/x_core_err.log', $log_message, FILE_APPEND);

            echo "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>SYSTEM ERROR // X-Core</title>
                    <link href='https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;700&display=swap' rel='stylesheet'>
                    <style>
                        body {
                            background-color: #0f0f1a;
                            color: #e0e0e0;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                            font-family: 'Fira Code', monospace;
                        }
                        .error-container {
                            background-color: #1a1a2e;
                            padding: 40px;
                            border-radius: 8px;
                            border: 1px solid #ff3366;
                            border-left: 6px solid #ff3366;
                            box-shadow: 0 0 20px rgba(255, 51, 102, 0.2);
                            max-width: 600px;
                            width: 90%;
                        }
                        .error-header {
                            color: #ff3366;
                            font-size: 24px;
                            margin-top: 0;
                            margin-bottom: 20px;
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                        }
                        .error-header::before {
                            content: '[!]';
                            animation: blink 1.2s infinite;
                        }
                        .error-body {
                            color: #00ffff;
                            font-size: 15px;
                            line-height: 1.8;
                            margin-bottom: 30px;
                        }
                        .error-footer {
                            color: #a0a0b5;
                            font-size: 12px;
                            border-top: 1px dashed rgba(255, 255, 255, 0.1);
                            padding-top: 15px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .btn-reboot {
                            display: inline-block;
                            background: transparent;
                            color: #ff3366;
                            text-decoration: none;
                            border: 1px solid #ff3366;
                            padding: 8px 15px;
                            border-radius: 4px;
                            font-weight: bold;
                            transition: all 0.3s;
                            font-size: 14px;
                        }
                        .btn-reboot:hover {
                            background: #ff3366;
                            color: #0f0f1a;
                            box-shadow: 0 0 15px rgba(255, 51, 102, 0.5);
                        }
                        @keyframes blink {
                            0%, 100% { opacity: 1; }
                            50% { opacity: 0; }
                        }
                    </style>
                </head>
                <body>
                    <div class='error-container'>
                        <h3 class='error-header'>CRITICAL_FAILURE</h3>
                        <div class='error-body'>
                            > CONNECTION_LOST: The X-Core could not be reached.<br>
                            > ACTION: Anomaly logged. Engineering team notified.
                        </div>
                        <div class='error-footer'>
                            <span>CODE: X_DB_FAULT | TIME: {$timestamp}</span>
                            <a href='index.php' class='btn-reboot'>INITIATE_REBOOT</a>
                        </div>
                    </div>
                </body>
                </html>
                ";
            exit;
        }
        return $this->conn;
    }
}
