<?php

include "country.php";

class CountryService
{
    public function addCountry($country)
    {
        global $conn;
		$country_id_sal = $country->getCountry_id_sal();
		$language = $country->getLanguage();
        $name = $country->getName();
        $flag = $country->getFlag();
        $dialing_code = $country->getDialing_code();
        $iso_code = $country->getIso_code();
        $currency = $country->getCurrency();
        $sql = $conn->prepare("INSERT INTO countries (country_id_sal, language, name, flag, dialing_code, iso_code, currency) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("issssss", $country_id_sal, $language, $name, $falg, $dialing_code, $iso_code, $currency);
        $sql->execute();
    }

    public function getCountryById($id)
    {
        global $conn;
        $sql = "SELECT * FROM countries WHERE country_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = new Country();
            $country->setCountry_id($row["country_id"]);
			$country->setCountry_id_sal($row['country_id_sal']);
			$country->setLanguage($row['language']);
            $country->setName($row["name"]);
            $country->setFlag($row["flag"]);
            $country->setDialing_code($row["dialing_code"]);
            $country->setIso_code($row["iso_code"]);
            $country->setCurrency($row["currency"]);
            return $country;
        }
    }

    public function getCountryByName($name)
    {
        global $conn;
        $sql = "SELECT * FROM countries WHERE name='$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = new Country();
            $country->setCountry_id($row["country_id"]);
			$country->setCountry_id_sal($row['country_id_sal']);
			$country->setLanguage($row['language']);
            $country->setName($row["name"]);
            $country->setFlag($row["flag"]);
            $country->setDialing_code($row["dialing_code"]);
            $country->setIso_code($row["iso_code"]);
            $country->setCurrency($row["currency"]);
            return $country;
        }
    }

    public function getCountryByIsoCode($iso_code, $language)
    {
        global $conn;
        $sql = "SELECT * FROM countries WHERE iso_code='$iso_code' AND language='$language'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = new Country();
            $country->setCountry_id($row["country_id"]);
			$country->setCountry_id_sal($row['country_id_sal']);
			$country->setLanguage($row['language']);
            $country->setName($row["name"]);
            $country->setFlag($row["flag"]);
            $country->setDialing_code($row["dialing_code"]);
            $country->setIso_code($row["iso_code"]);
            $country->setCurrency($row["currency"]);
            return $country;
        }
    }
	
	public function getCountryByDialingCode($dialing_code)
    {
        global $conn;
        $sql = "SELECT * FROM countries WHERE dialing_code='$dialing_code'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = new Country();
            $country->setCountry_id($row["country_id"]);
			$country->setCountry_id_sal($row['country_id_sal']);
			$country->setLanguage($row['language']);
            $country->setName($row["name"]);
            $country->setFlag($row["flag"]);
            $country->setDialing_code($row["dialing_code"]);
            $country->setIso_code($row["iso_code"]);
            $country->setCurrency($row["currency"]);
            return $country;
        }
    }

    public function updateCountryById($country)
    {
        global $conn;
		$country_id_sal = $country->getCountry_id_sal();
		$language = $country->getLanguage();
        $country_id = $country->getCountry_id();
        $name = $country->getName();
        $flag = $country->getFlag();
        $dialing_code = $country->getDialing_code();
        $iso_code = $country->getIso_code();
        $currency = $country->getCurrency();
        $sql = $conn->prepare("UPDATE countries SET country_id_sal=?, language=?, name=?, flag=?, dialing_code=?, iso_code=?, currency=? WHERE country_id=?");
        $sql->bind_param("issssssi", $country_id_sal, $language, $name, $flag, $dialing_code, $iso_code, $currency, $country_id);
        $sql->execute();
    }

    public function deleteCountryById($id)
    {
        global $conn;
        $sql = "DELETE FROM countries WHERE country_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllCountries($language)
    {
		global $conn;
        $sql = "SELECT * FROM countries WHERE language='$language'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $countriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $country = new Country();
                $country->setCountry_id($row["country_id"]);
				$country->setCountry_id_sal($row['country_id_sal']);
				$country->setLanguage($row['language']);
                $country->setName($row["name"]);
                $country->setFlag($row["flag"]);
                $country->setDialing_code($row["dialing_code"]);
                $country->setIso_code($row["iso_code"]);
                $country->setCurrency($row["currency"]);
                array_push($countriesObjects, $country);
            }
            return $countriesObjects;
        }
    }
}
