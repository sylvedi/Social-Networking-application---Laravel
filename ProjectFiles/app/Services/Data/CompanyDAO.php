<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;

/**
 * Implements CRUD operations for the CREDENTIALS table
 *
 * @author Jake McDermitt
 */
class CompanyDAO implements IDataAccessObject
{

    private $db;

    /**
     * Instantiates the object with a database connection
     *
     * @param PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::create()
     */
    public function create($model)
    {
        Log::info("Entering CompanyDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `companies`(`id`, `NAME`) VALUES (NULL, :name)";

            $name = $model->getName();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':name', $name);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CompanyDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit CompanyDAO.create() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readAll()
     */
    public function readAll()
    {
        Log::info("Entering CompanyDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM COMPANIES WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CompanyDAO.readAll() with success");
                return $stmt;
            } else {

                Log::info("Exit CompanyDAO.readAll() with failure.");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readById()
     */
    public function readById($id)
    {
        Log::info("Entering CompanyDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM COMPANIES WHERE id=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {

                Log::info("Exit CompanyDAO.readById($id) with success");
                return $stmt;
            } else {

                Log::info("Exit CompanyDAO.readById($id) with failure. Data:{id: " . $id . "}");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readByModel()
     */
    public function readByModel($model)
    {
        Log::info("Entering CompanyDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM COMPANIES WHERE";

            $name = $model->getName();

            $count = 0;
            if ($name != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " NAME=:name";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($name != null) {
                $stmt->bindParam(':name', $name);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CompanyDAO.readByModel() with success");
                return $stmt;
            } else {

                Log::info("Exit CompanyDAO.readByModel() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::update()
     */
    public function update($model)
    {
        Log::info("Entering CompanyDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE COMPANIES SET ";

            $id = $model->getId();
            $name = $model->getName();

            $count = 0;
            if ($name != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `NAME`=:name";
                $count ++;
            }

            $query = $query . " WHERE id=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($name != null) {
                $stmt->bindParam(':name', $name);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CompanyDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit CompanyDAO.update() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::delete()
     */
    public function delete($id)
    {
        Log::info("Entering CompanyDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM COMPANIES WHERE id = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CompanyDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit CompanyDAO.delete() with failure");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}