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
class EducationDAO implements IDataAccessObject
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
        Log::info("Entering EducationDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `education`(`id`, `USERS_ID`, `SCHOOL`, `DESCRIPTION`) VALUES (NULL, :users_id, :school, :description)";

            $id = $model->getId();
            $school = $model->getSchool();
            $description = $model->getDescription();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':users_id', $id);
            $stmt->bindParam(':school', $school);
            $stmt->bindParam(':description', $description);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit EducationDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit EducationDAO.create() with failure. Data:{" . $model . "}");
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
        Log::info("Entering EducationDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM EDUCATION WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit EducationDAO.readAll() with success");
                return $stmt;
            } else {

                Log::info("Exit EducationDAO.readAll() with failure.");
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
        Log::info("Entering EducationDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM EDUCATION WHERE USERS_ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result || $stmt->rowCount() == 1) {

                Log::info("Exit EducationDAO.readById($id) with success");
                return $stmt;
            } else {

                Log::info("Exit EducationDAO.readById($id) with failure. Data:{id: " . $id . "}");
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
        Log::info("Entering EducationDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM EDUCATION WHERE";

            $id = $model->getId();
            $school = $model->getSchool();
            $description = $model->getDescription();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " USERS_ID=:id";
                $count ++;
            }
            if ($school != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " SCHOOL=:school";
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
            if ($school != null) {
                $stmt->bindParam(':school', $school);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit EducationDAO.readByModel() with success");
                return $stmt;
            } else {

                Log::info("Exit EducationDAO.readByModel() with failure. Data:{" . $model . "}");
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
        Log::info("Entering EducationDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE EDUCATION SET ";

            $id = $model->getId();
            $school = $model->getSchool();
            $description = $model->getDescription();

            $count = 0;
            if ($school != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " SCHOOL=:school";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " DESCRIPTION=:description";
                $count ++;
            }

            $query = $query . " WHERE USERS_ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($school != null) {
                $stmt->bindParam(':school', $school);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit EducationDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit EducationDAO.update() with failure. Data:{" . $model . "}");
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
        Log::info("Entering EducationDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM EDUCATION WHERE USERS_ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit EducationDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit EducationDAO.delete() with failure");
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