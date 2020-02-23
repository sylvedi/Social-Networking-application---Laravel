<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use App\Models\JobModel;
use PDO;
use PDOException;

/**
 * Implements CRUD operations for the CREDENTIALS table
 *
 * @author Jake McDermitt
 */
class JobDAO implements IDataAccessObject
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
        Log::info("Entering JobDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `jobs`(`id`, `COMPANIES_ID`, `TITLE`, `DESCRIPTION`) VALUES (NULL, :company_id, :title, :description)";

            $id = $model->getCompanyid();
            $title = $model->getTitle();
            $description = $model->getDescription();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':company_id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit JobDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit JobDAO.create() with failure. Data:{" . $model . "}");
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
        Log::info("Entering JobDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM JOBS WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {
                $result = array();
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, new JobModel($data['ID'], $data['COMPANIES_ID'], $data['TITLE'], $data['DESCRIPTION']));
                }
                Log::info("Exit JobDAO.readAll() with success");
                return $result;
            } else {

                Log::info("Exit JobDAO.readAll() with failure.");
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
        Log::info("Entering JobDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM JOBS WHERE ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $result = new JobModel($data['ID'], $data['COMPANIES_ID'], $data['TITLE'], $data['DESCRIPTION']);
                Log::info("Exit JobDAO.readById($id) with success");
                return $result;
            } else {

                Log::info("Exit JobDAO.readById($id) with failure. Data:{id: " . $id . "}");
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
        Log::info("Entering JobDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM JOBS WHERE";

            $id = $model->getCompanyid();
            $title = $model->getTitle();
            $description = $model->getDescription();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " COMPANIES_ID=:id";
                $count ++;
            }
            if ($title != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " TITLE=:title";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " DESCRIPTION=:description";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($id != null) {
                $stmt->bindParam(':id', $id);
            }
            if ($title != null) {
                $stmt->bindParam(':title', $title);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {
                $result = array();
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, new JobModel($data['ID'], $data['COMPANIES_ID'], $data['TITLE'], $data['DESCRIPTION']));
                }
                Log::info("Exit JobDAO.readByModel() with success");
                return $result;
            } else {

                Log::info("Exit JobDAO.readByModel() with failure. Data:{" . $model . "}");
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
        Log::info("Entering JobDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE JOBS SET ";

            $id = $model->getId();
            $title = $model->getTitle();
            $description = $model->getDescription();

            $count = 0;
            if ($title != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `TITLE`=:title";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `DESCRIPTION`=:description";
                $count ++;
            }

            $query = $query . " WHERE ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($title != null) {
                $stmt->bindParam(':title', $title);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit JobDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit JobDAO.update() with failure. Data:{" . $model . "}");
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
        Log::info("Entering JobDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM JOBS WHERE ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit JobDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit JobDAO.delete() with failure");
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