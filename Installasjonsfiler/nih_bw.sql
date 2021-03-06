/****** Object:  Database [nih_bw]    Script Date: 12.05.2014 10:50:13 ******/
CREATE DATABASE [nih_bw] ON  PRIMARY 
( NAME = N'nih_bw', FILENAME = N'd:\Programmer\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\nih_bw.mdf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'nih_bw_log', FILENAME = N'd:\Programmer\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\nih_bw_log.ldf' , SIZE = 2048KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [nih_bw].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [nih_bw] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [nih_bw] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [nih_bw] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [nih_bw] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [nih_bw] SET ARITHABORT OFF 
GO
ALTER DATABASE [nih_bw] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [nih_bw] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [nih_bw] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [nih_bw] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [nih_bw] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [nih_bw] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [nih_bw] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [nih_bw] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [nih_bw] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [nih_bw] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [nih_bw] SET  DISABLE_BROKER 
GO
ALTER DATABASE [nih_bw] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [nih_bw] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [nih_bw] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [nih_bw] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [nih_bw] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [nih_bw] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [nih_bw] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [nih_bw] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [nih_bw] SET  MULTI_USER 
GO
ALTER DATABASE [nih_bw] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [nih_bw] SET DB_CHAINING OFF 
GO
USE [nih_bw]
GO
/****** Object:  Schema [m2ss]    Script Date: 12.05.2014 10:50:14 ******/
CREATE SCHEMA [m2ss]
GO
/****** Object:  Table [dbo].[change_log]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[change_log](
	[id] [int] IDENTITY(4,1) NOT NULL,
	[routine_id] [int] NOT NULL,
	[title] [varchar](25) NOT NULL,
	[value_old] [varchar](10) NOT NULL,
	[value_new] [varchar](10) NULL,
	[action] [varchar](10) NOT NULL,
	[changed_at] [date] NOT NULL,
	[date] [date] NOT NULL,
	[time] [time](0) NOT NULL,
	[changed_by] [varchar](30) NULL,
 CONSTRAINT [PK_change_log_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[emps]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[emps](
	[id] [int] IDENTITY(7,1) NOT NULL,
	[user_name] [varchar](25) NOT NULL,
	[first_name] [varchar](15) NOT NULL,
	[last_name] [varchar](15) NOT NULL,
	[email] [varchar](25) NOT NULL,
	[password] [varchar](60) NOT NULL,
	[user_type] [char](5) NOT NULL,
	[active] [smallint] NOT NULL,
	[created_at] [datetime2](0) NULL,
	[updated_at] [datetime2](0) NULL,
	[deleted_at] [datetime2](0) NULL,
 CONSTRAINT [PK_emps_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[measure_routine]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[measure_routine](
	[routine_id] [int] NOT NULL,
	[measure_id] [int] NOT NULL,
	[pool_id] [int] NULL,
 CONSTRAINT [PK_measure_routine_routine_id] PRIMARY KEY CLUSTERED 
(
	[routine_id] ASC,
	[measure_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[measurements]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[measurements](
	[id] [int] IDENTITY(25,1) NOT NULL,
	[title] [varchar](25) NOT NULL,
 CONSTRAINT [PK_measurements_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[pools]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[pools](
	[id] [int] IDENTITY(100,1) NOT NULL,
	[name] [varchar](20) NOT NULL,
 CONSTRAINT [PK_pools_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[routines]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[routines](
	[id] [int] IDENTITY(559,1) NOT NULL,
	[date] [date] NOT NULL,
	[time] [time](0) NOT NULL,
	[value] [varchar](10) NOT NULL,
	[emp_id] [int] NOT NULL,
 CONSTRAINT [PK_routines_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[task_routine]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[task_routine](
	[routine_id] [int] NOT NULL,
	[task_id] [int] NOT NULL,
 CONSTRAINT [PK_task_routine_routine_id] PRIMARY KEY CLUSTERED 
(
	[routine_id] ASC,
	[task_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tasks]    Script Date: 12.05.2014 10:50:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tasks](
	[id] [int] IDENTITY(89,1) NOT NULL,
	[title] [varchar](75) NOT NULL,
 CONSTRAINT [PK_tasks_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[emps] ON 

INSERT [dbo].[emps] ([id], [user_name], [first_name], [last_name], [email], [password], [user_type], [active], [created_at], [updated_at], [deleted_at]) VALUES (22, N'RootR', N'Root', N'Root', N'Root@root.root', N'$2y$10$AOI.opoi4OI8hYX/Ij8dYuPskzk3XLhQz5l1clniaq.Rz0REfbOBy', N'admin', 1, CAST(0x00DA970084380B0000 AS DateTime2), CAST(0x00DA970084380B0000 AS DateTime2), NULL)
SET IDENTITY_INSERT [dbo].[emps] OFF
SET IDENTITY_INSERT [dbo].[measurements] ON 

INSERT [dbo].[measurements] ([id], [title]) VALUES (1, N'T_Badende_per_Time')
INSERT [dbo].[measurements] ([id], [title]) VALUES (2, N'T_Temperatur')
INSERT [dbo].[measurements] ([id], [title]) VALUES (3, N'T_Luft_Temperatur')
INSERT [dbo].[measurements] ([id], [title]) VALUES (4, N'M_Fritt_Klor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (5, N'M_Bundet_Klor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (6, N'M_Total_Klor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (7, N'M_PH')
INSERT [dbo].[measurements] ([id], [title]) VALUES (8, N'M_Auto_Klor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (9, N'M_Auto_PH')
INSERT [dbo].[measurements] ([id], [title]) VALUES (10, N'M_Redox')
INSERT [dbo].[measurements] ([id], [title]) VALUES (11, N'O_Vannbalanse')
INSERT [dbo].[measurements] ([id], [title]) VALUES (12, N'O_Alakalitet')
INSERT [dbo].[measurements] ([id], [title]) VALUES (13, N'O_Hardhet')
INSERT [dbo].[measurements] ([id], [title]) VALUES (14, N'O_Natrium_Bk')
INSERT [dbo].[measurements] ([id], [title]) VALUES (15, N'O_Kals_Klor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (16, N'O_Sjokklor')
INSERT [dbo].[measurements] ([id], [title]) VALUES (17, N'O_Fellingsmiddel')
INSERT [dbo].[measurements] ([id], [title]) VALUES (18, N'O_Sirkulasjonsmengde')
INSERT [dbo].[measurements] ([id], [title]) VALUES (19, N'O_Filtertrykk')
INSERT [dbo].[measurements] ([id], [title]) VALUES (20, N'O_Spyl_Av_Filter')
INSERT [dbo].[measurements] ([id], [title]) VALUES (21, N'O_Vannforbruk')
INSERT [dbo].[measurements] ([id], [title]) VALUES (22, N'O_Slamsuging')
INSERT [dbo].[measurements] ([id], [title]) VALUES (23, N'O_Harsil')
INSERT [dbo].[measurements] ([id], [title]) VALUES (24, N'O_Ren_Utj_Tank')
SET IDENTITY_INSERT [dbo].[measurements] OFF
SET IDENTITY_INSERT [dbo].[pools] ON 

INSERT [dbo].[pools] ([id], [name]) VALUES (1, N'Hovedbasseng')
INSERT [dbo].[pools] ([id], [name]) VALUES (2, N'Plaskebasseng')
INSERT [dbo].[pools] ([id], [name]) VALUES (99, N'Svommehall')
SET IDENTITY_INSERT [dbo].[pools] OFF
SET IDENTITY_INSERT [dbo].[tasks] ON 

INSERT [dbo].[tasks] ([id], [title]) VALUES (40, N'D_Slamsuge_Pl_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (41, N'D_Filter_Rens')
INSERT [dbo].[tasks] ([id], [title]) VALUES (42, N'D_Bypass_Pl_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (43, N'D_Vaske_Gulv_CM')
INSERT [dbo].[tasks] ([id], [title]) VALUES (44, N'D_Garderobe_0730')
INSERT [dbo].[tasks] ([id], [title]) VALUES (45, N'D_Garderobe_Dag')
INSERT [dbo].[tasks] ([id], [title]) VALUES (46, N'D_Male_Temp_Just')
INSERT [dbo].[tasks] ([id], [title]) VALUES (47, N'D_Vaske_Pl_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (48, N'D_Vaske_H_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (50, N'D_Ettersyn_Utst_Skap')
INSERT [dbo].[tasks] ([id], [title]) VALUES (51, N'D_Handicap_Heis')
INSERT [dbo].[tasks] ([id], [title]) VALUES (52, N'D_Ettersyn_solarier')
INSERT [dbo].[tasks] ([id], [title]) VALUES (53, N'D_Vannprove_0745')
INSERT [dbo].[tasks] ([id], [title]) VALUES (54, N'D_Vannprover_1100')
INSERT [dbo].[tasks] ([id], [title]) VALUES (55, N'D_Vannprover_1400')
INSERT [dbo].[tasks] ([id], [title]) VALUES (56, N'D_Enkle_Vedliks_Oppg')
INSERT [dbo].[tasks] ([id], [title]) VALUES (57, N'D_Sjekk_Skiftplan')
INSERT [dbo].[tasks] ([id], [title]) VALUES (58, N'K_Oppdatere_Seg_IkkeUtf')
INSERT [dbo].[tasks] ([id], [title]) VALUES (59, N'K_Vannprover_1700')
INSERT [dbo].[tasks] ([id], [title]) VALUES (60, N'K_Vannprover_2000')
INSERT [dbo].[tasks] ([id], [title]) VALUES (61, N'K_Vaske_Pl_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (62, N'K_Vaske_H_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (63, N'K_Sla_Av_Bypass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (64, N'K_Ettersyn_Materiell')
INSERT [dbo].[tasks] ([id], [title]) VALUES (65, N'K_Ettersyn_Solarier')
INSERT [dbo].[tasks] ([id], [title]) VALUES (66, N'K_Ettersyn_Sal_4')
INSERT [dbo].[tasks] ([id], [title]) VALUES (67, N'K_Runde_Gard_Kveld')
INSERT [dbo].[tasks] ([id], [title]) VALUES (68, N'K_Runde_Gard_For_Steng')
INSERT [dbo].[tasks] ([id], [title]) VALUES (69, N'K_Enkle_Vedlik_Oppg')
INSERT [dbo].[tasks] ([id], [title]) VALUES (70, N'K_Rullestolheis_lading')
INSERT [dbo].[tasks] ([id], [title]) VALUES (71, N'K_Etterfylle_Skoposer')
INSERT [dbo].[tasks] ([id], [title]) VALUES (72, N'K_Skap_Lases')
INSERT [dbo].[tasks] ([id], [title]) VALUES (73, N'K_Sjekk_Skiftplan')
INSERT [dbo].[tasks] ([id], [title]) VALUES (74, N'K_Rydd_Tribune')
INSERT [dbo].[tasks] ([id], [title]) VALUES (75, N'K_Slamsug_H_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (76, N'K_Stenge_Prosedyre')
INSERT [dbo].[tasks] ([id], [title]) VALUES (77, N'K_Beskjed_H_Vakt')
INSERT [dbo].[tasks] ([id], [title]) VALUES (78, N'K_Timeteller')
INSERT [dbo].[tasks] ([id], [title]) VALUES (79, N'C_Timeteller')
INSERT [dbo].[tasks] ([id], [title]) VALUES (80, N'C_AllRent')
INSERT [dbo].[tasks] ([id], [title]) VALUES (81, N'C_Grovrent_Ekstra')
INSERT [dbo].[tasks] ([id], [title]) VALUES (82, N'C_Ren_Opplos_Tank')
INSERT [dbo].[tasks] ([id], [title]) VALUES (83, N'C_Ren_Opps_Tank')
INSERT [dbo].[tasks] ([id], [title]) VALUES (84, N'C_Ren_Flott_gitter')
INSERT [dbo].[tasks] ([id], [title]) VALUES (85, N'C_Ren_Opplos_Filter')
INSERT [dbo].[tasks] ([id], [title]) VALUES (86, N'C_Ren_Nal')
INSERT [dbo].[tasks] ([id], [title]) VALUES (87, N'C_Kontr_Slang_Tank')
INSERT [dbo].[tasks] ([id], [title]) VALUES (88, N'C_Kont_Ren_KostPad')
INSERT [dbo].[tasks] ([id], [title]) VALUES (89, N'H_Slamsuge_Pl_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (90, N'H_Vannprov_Reg_1400')
INSERT [dbo].[tasks] ([id], [title]) VALUES (91, N'H_Vaske_Kortkanter')
INSERT [dbo].[tasks] ([id], [title]) VALUES (92, N'H_Vannprov_Reg_1700')
INSERT [dbo].[tasks] ([id], [title]) VALUES (93, N'H_Vaske_Gulv_CM')
INSERT [dbo].[tasks] ([id], [title]) VALUES (94, N'H_Sjekke_Syreflow')
INSERT [dbo].[tasks] ([id], [title]) VALUES (95, N'H_Runde_Gard_Morgen')
INSERT [dbo].[tasks] ([id], [title]) VALUES (96, N'H_Sjekke_klorfat_Syrekanner_flockmiddel_Kalsiumklorid')
INSERT [dbo].[tasks] ([id], [title]) VALUES (97, N'H_Runde_Gard_Midt_Dag')
INSERT [dbo].[tasks] ([id], [title]) VALUES (98, N'H_Tomme_Soppel_Pose')
INSERT [dbo].[tasks] ([id], [title]) VALUES (99, N'H_Male_Temp_Just')
INSERT [dbo].[tasks] ([id], [title]) VALUES (100, N'H_Enkle_Vedlikholds_Oppg')
INSERT [dbo].[tasks] ([id], [title]) VALUES (101, N'H_Ettersyn_Utstyr_Skap')
INSERT [dbo].[tasks] ([id], [title]) VALUES (102, N'H_Skap_lases')
INSERT [dbo].[tasks] ([id], [title]) VALUES (103, N'H_Handicap_Heis')
INSERT [dbo].[tasks] ([id], [title]) VALUES (104, N'H_Rydde_Tribune_Soppel')
INSERT [dbo].[tasks] ([id], [title]) VALUES (105, N'H_Ettersyn_Solarier_X2')
INSERT [dbo].[tasks] ([id], [title]) VALUES (106, N'H_Sette_Slamsugeren_H_Bass')
INSERT [dbo].[tasks] ([id], [title]) VALUES (107, N'H_Vannprov_Reg_0830')
INSERT [dbo].[tasks] ([id], [title]) VALUES (108, N'H_Slukke_lys_Stenge_lase_dor')
INSERT [dbo].[tasks] ([id], [title]) VALUES (109, N'H_Vannprov_Reg_1100')
INSERT [dbo].[tasks] ([id], [title]) VALUES (110, N'H_Beskjed_H_vakta')
INSERT [dbo].[tasks] ([id], [title]) VALUES (111, N'K_Forrige_Uke_Badende')
INSERT [dbo].[tasks] ([id], [title]) VALUES (112, N'K_RundeGard_2_Ganger')
INSERT [dbo].[tasks] ([id], [title]) VALUES (113, N'K_klorfat_Syrekanner_Flockmiddel_Kalsklorid')
INSERT [dbo].[tasks] ([id], [title]) VALUES (114, N'K_Sjekk_syreflow')
INSERT [dbo].[tasks] ([id], [title]) VALUES (115, N'K_Kontroll_Wc')
INSERT [dbo].[tasks] ([id], [title]) VALUES (116, N'K_Soppel_WC')
INSERT [dbo].[tasks] ([id], [title]) VALUES (117, N'K_Stenge_Prosedyre')
INSERT [dbo].[tasks] ([id], [title]) VALUES (118, N'D_Vannmengde_08')
INSERT [dbo].[tasks] ([id], [title]) VALUES (120, N'D_Renhold_Av_Wc')
INSERT [dbo].[tasks] ([id], [title]) VALUES (121, N'D_Vannprover_0745')
INSERT [dbo].[tasks] ([id], [title]) VALUES (122, N'D_Enkle_Vedlikholds_Oppg')
SET IDENTITY_INSERT [dbo].[tasks] OFF
/****** Object:  Index [link3]    Script Date: 12.05.2014 10:50:14 ******/
CREATE NONCLUSTERED INDEX [link3] ON [dbo].[measure_routine]
(
	[measure_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [pool_id]    Script Date: 12.05.2014 10:50:14 ******/
CREATE NONCLUSTERED INDEX [pool_id] ON [dbo].[measure_routine]
(
	[pool_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [emp_id]    Script Date: 12.05.2014 10:50:14 ******/
CREATE NONCLUSTERED INDEX [emp_id] ON [dbo].[routines]
(
	[emp_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [link6]    Script Date: 12.05.2014 10:50:14 ******/
CREATE NONCLUSTERED INDEX [link6] ON [dbo].[task_routine]
(
	[task_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[change_log] ADD  CONSTRAINT [DF__change_lo__value__15502E78]  DEFAULT (NULL) FOR [value_new]
GO
ALTER TABLE [dbo].[measure_routine] ADD  DEFAULT (NULL) FOR [pool_id]
GO
ALTER TABLE [dbo].[measure_routine]  WITH NOCHECK ADD  CONSTRAINT [measure_routine$link2] FOREIGN KEY([routine_id])
REFERENCES [dbo].[routines] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[measure_routine] CHECK CONSTRAINT [measure_routine$link2]
GO
ALTER TABLE [dbo].[measure_routine]  WITH NOCHECK ADD  CONSTRAINT [measure_routine$link3] FOREIGN KEY([measure_id])
REFERENCES [dbo].[measurements] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[measure_routine] CHECK CONSTRAINT [measure_routine$link3]
GO
ALTER TABLE [dbo].[measure_routine]  WITH NOCHECK ADD  CONSTRAINT [measure_routine$link99] FOREIGN KEY([pool_id])
REFERENCES [dbo].[pools] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[measure_routine] CHECK CONSTRAINT [measure_routine$link99]
GO
ALTER TABLE [dbo].[routines]  WITH NOCHECK ADD  CONSTRAINT [routines$link1] FOREIGN KEY([emp_id])
REFERENCES [dbo].[emps] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[routines] CHECK CONSTRAINT [routines$link1]
GO
ALTER TABLE [dbo].[task_routine]  WITH NOCHECK ADD  CONSTRAINT [task_routine$link5] FOREIGN KEY([routine_id])
REFERENCES [dbo].[routines] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[task_routine] CHECK CONSTRAINT [task_routine$link5]
GO
ALTER TABLE [dbo].[task_routine]  WITH NOCHECK ADD  CONSTRAINT [task_routine$link6] FOREIGN KEY([task_id])
REFERENCES [dbo].[tasks] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[task_routine] CHECK CONSTRAINT [task_routine$link6]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.change_log' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'change_log'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.emps' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'emps'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.measure_routine' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'measure_routine'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.measurements' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'measurements'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.pools' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pools'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.routines' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'routines'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.task_routine' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'task_routine'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'nih_bw.tasks' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'tasks'
GO
USE [master]
GO
ALTER DATABASE [nih_bw] SET  READ_WRITE 
GO
