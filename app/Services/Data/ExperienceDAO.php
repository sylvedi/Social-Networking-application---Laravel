<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;
use App\Models\ExperienceModel;

/**
 * Implements CRUD operations for the EXPERIENCE table
 *
 * @author Jake McDermitt
 */
class ExperienceDAO implements IDataAccessObject
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
        Log::info("Entering ExperienceDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `experience`(`id`, `USERS_ID`, `COMPANY`, `JOBTITLE`, `DESCRIPTION`, `STARTDATE`, `ENDDATE`, `CURRENTJOB`) VALUES (NULL, :users_id, :company, :jobtitle, :description, :startdate, :enddate, :currentjob)";

            $id = $model->getUserid();
            $company = $model->getCompany();
            $jobtitle = $model->getJobtitle();
            $description = $model->getDescription();
            $startdate = $model->getStartdate();
            $enddate = $model->getEnddate();
            $currentjob = $model->getCurrentjob();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':users_id', $id);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':jobtitle', $jobtitle);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':startdate', $startdate);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':currentjob', $currentjob);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit ExperienceDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit ExperienceDAO.create() with failure. Data:{" . $model . "}");
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
        Log::info("Entering ExperienceDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM EXPERIENCE WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {
                $result = array();
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, new ExperienceModel($data['ID'], $data['USERS_ID'], $data['COMPANY'], $data['JOBTITLE'], $data['DESCRIPTION'], $data['STARTDATE'], $data['ENDDATE'], $data['CURRENTJOB']));
                }
                Log::info("Exit ExperienceDAO.readAll() with success");
                return $result;
            } else {

                Log::info("Exit ExperienceDAO.readAll() with failure.");
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
        Log::info("Entering ExperienceDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM EXPERIENCE WHERE ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {

                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $experience = new ExperienceModel($data['ID'], $data['USERS_ID'], $data['COMPANY'], $data['JOBTITLE'], $data['DESCRIPTION'], $data['STARTDATE'], $data['ENDDATE'], $data['CURRENTJOB']);
                Log::info("Exit ExperienceDAO.readById($id) with success");
                return $experience;
            } else {

                Log::info("Exit ExperienceDAO.readById($id) with failure. Data:{id: " . $id . "}");
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
        Log::info("Entering ExperienceDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM EXPERIENCE WHERE";

            $id = $model->getUserid();
            $company = $model->getCompany();
            $jobtitle = $model->getJobtitle();
            $description = $model->getDescription();
            $startdate = $model->getStartdate();
            $enddate = $model->getEnddate();
            $currentjob = $model->getCurrentjob();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " USERS_ID=:id";
                $count ++;
            }
            if ($company != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " COMPANY=:company";
                $count ++;
            }
            if ($jobtitle != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " JOBTITLE=:jobtitle";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " DESCRIPTION=:description";
                $count ++;
            }
            if ($startdate != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " `STARTDATE`=:startdate";
                $count ++;
            }
            if ($enddate != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " `ENDDATE`=:enddate";
                $count ++;
            }
            if ($currentjob != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " `CURRENTJOB`=:currentjob";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($id != null) {
                $stmt->bindParam(':id', $id);
            }
            if ($company != null) {
                $stmt->bindParam(':company', $company);
            }
            if ($jobtitle != null) {
                $stmt->bindParam(':jobtitle', $jobtitle);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }
            if ($startdate != null) {
                $stmt->bindParam(':startdate', $startdate);
            }
            if ($enddate != null) {
                $stmt->bindParam(':enddate', $enddate);
            }
            if ($currentjob != null) {
                $stmt->bindParam(':currentjob', $currentjob);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {
                $result = array();
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, new ExperienceModel($data['ID'], $data['USERS_ID'], $data['COMPANY'], $data['JOBTITLE'], $data['DESCRIPTION'], $data['STARTDATE'], $data['ENDDATE'], $data['CURRENTJOB']));
                }
                Log::info("Exit ExperienceDAO.readByModel() with success");
                return $result;
            } else {

                Log::info("Exit ExperienceDAO.readByModel() with failure. Data:{" . $model . "}");
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
        Log::info("Entering ExperienceDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE EXPERIENCE SET ";

            $id = $model->getId();
            $company = $model->getCompany();
            $jobtitle = $model->getJobtitle();
            $description = $model->getDescription();
            $startdate = $model->getStartdate();
            $enddate = $model->getEnddate();
            $currentjob = ($model->getCurrentjob() == true ? 1 : 0); // TODO there is a bug here where the column won't update to 0

            $count = 0;
            if ($company != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `COMPANY`=:company";
                $count ++;
            }
            if ($jobtitle != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `JOBTITLE`=:jobtitle";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `DESCRIPTION`=:description";
                $count ++;
            }
            if ($startdate != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `STARTDATE`=:startdate";
                $count ++;
            }
            if ($enddate != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `ENDDATE`=:enddate";
                $count ++;
            }
            if ($currentjob != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `CURRENTJOB`=:currentjob";
                $count ++;
            }

            $query = $query . " WHERE ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($company != null) {
                $stmt->bindParam(':company', $company);
            }
            if ($jobtitle != null) {
                $stmt->bindParam(':jobtitle', $jobtitle);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }
            if ($startdate != null) {
                $stmt->bindParam(':startdate', $startdate);
            }
            if ($enddate != null) {
                $stmt->bindParam(':enddate', $enddate);
            }
            if ($currentjob != null) {
                $stmt->bindParam(':currentjob', $currentjob);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit ExperienceDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit ExperienceDAO.update() with failure. Data:{" . $model . "}");
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
        Log::info("Entering ExperienceDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM EXPERIENCE WHERE ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit ExperienceDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit ExperienceDAO.delete() with failure");
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