-- Schema and data for Movies database.
use master;
DROP DATABASE IF EXISTS Movies;
CREATE DATABASE Movies;
GO
USE Movies
GO
CREATE LOGIN applicatie WITH PASSWORD = 'Bam1schijf';
CREATE USER applicatie;
ALTER ROLE db_datareader ADD MEMBER applicatie;
ALTER ROLE db_datawriter ADD MEMBER applicatie;
ALTER DATABASE [Movies] SET MULTI_USER;
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Add tables