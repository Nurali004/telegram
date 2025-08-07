-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 07, 2025 at 06:02 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'PHP dasturlash tili', 'PHP'),
(2, 'Java dasturlash tili', 'Java'),
(3, 'Python dasturlash tili', 'Python'),
(4, 'Html dasturlash tili', 'html'),
(6, 'Value 1', 'Value 2'),
(8, 'Value 1', 'Value 2'),
(9, 'Value 1', 'Value 2'),
(10, 'Value 1', 'Value 2'),
(11, 'Value 1', 'Value 2'),
(12, 'Value 1', 'Value 2'),
(13, 'Value 1', 'Value 2'),
(14, 'Value 1', 'Value 2'),
(15, 'Value 1', 'Value 2'),
(16, 'Value 1', 'Value 2'),
(17, 'Value 1', 'Value 2'),
(18, 'Value 1', 'Value 2'),
(19, 'Value 1', 'Value 2'),
(22, 'messages from postman', 'slug of the postman');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Python dasturlashga muvafaqqiyatli qo\'shildingiz', '2025-07-22 21:31:00', '2025-07-22 21:31:00'),
(2, 1, 5, 'Java dasturlashga muvafaqqiyatli qo\'shildingiz', '2025-07-22 21:31:00', '2025-07-22 21:31:00'),
(5, 1, 4, 'Python dasturlashga muvafaqqiyatli qo\'shildingiz', '2025-07-22 21:31:00', '2025-07-22 21:31:00'),
(8, 2, 3, 'Backend dasturlashga muvafaqqiyatli qo\'shildingiz1', '2025-07-27 13:06:18', '2025-07-27 13:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `author` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `small_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `full_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `category_id`, `created_at`, `updated_at`, `author`, `title`, `small_text`, `full_text`, `image`, `status`) VALUES
(1, 4, '2025-07-22 19:40:01', '2025-07-22 19:40:01', 1, 'HTML 5-dars', 'HTML 1-dars', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', '', 1),
(3, 4, '2025-07-22 19:40:01', '2025-07-22 19:40:01', 1, 'HTML 2-dars', 'HTML 2-dars', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'HTML 2-dars', 1),
(4, 3, '2025-07-22 19:40:01', '2025-07-22 19:40:01', 1, 'Python 2-dars', 'Python 2-dars', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'Python 2-dars', 1),
(5, 2, '2025-07-22 19:40:01', '2025-07-22 19:40:01', 1, 'Java 2-dars', 'Java 2-dars', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'Java 2-dars', 1),
(6, 1, '2025-07-27 14:52:05', '2025-07-27 14:52:05', 2, 'backend', 'beckend 1-dars', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'beckend 1-dars', 2),
(7, 2, '2025-07-31 14:50:59', '2025-07-31 14:50:59', 1, 'Test file4', 'Test file', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'uploads/post/rasim_php.jpeg', 1),
(8, 2, '2025-07-31 21:19:51', '2025-07-31 21:19:51', 1, 'post test', 'post test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'uploads/post/rasim_php.jpeg', 1),
(9, NULL, '2025-07-31 21:52:18', '2025-07-31 21:52:18', 2, 'php haqida', 'php haqida', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus, est impedit ipsum magni molestiae nobis, non quisquam sapiente soluta, sunt totam voluptas voluptatibus. Aut consectetur illo incidunt nemo quibusdam quis quisquam, rem sit. Dolorum ex explicabo iste magni modi obcaecati quibusdam sequi! A ab, cupiditate expedita facilis mollitia veniam! Cumque dignissimos eos facere fugiat maxime nostrum, quae! Aliquam at error labore obcaecati sit? A blanditiis commodi cumque debitis deserunt dicta, dolore dolorem, dolores, ducimus earum enim eveniet laboriosam maxime molestias natus necessitatibus nihil nisi nostrum officia optio quaerat quasi qui quidem reprehenderit sequi sit ut voluptates! A aspernatur beatae culpa dolorum error eum id, nisi sapiente veritatis? Alias doloribus ipsa molestiae mollitia, obcaecati quas quis reiciendis rem repudiandae vel. Cumque deleniti eaque iusto nemo nobis provident reiciendis ut! Accusamus asperiores commodi consequuntur corporis culpa cum cupiditate deleniti distinctio dolore ducimus enim eos error, est harum, incidunt inventore itaque nostrum nulla possimus quibusdam quisquam rem repellendus reprehenderit sed similique vel voluptatibus. Accusamus asperiores assumenda at autem consectetur, deleniti deserunt dolorem doloremque eaque eligendi enim impedit in inventore ipsa iure labore libero maiores minus natus nesciunt nobis non placeat quaerat quia quidem quis quos ratione sequi sint totam! Accusamus adipisci, consequuntur cumque cupiditate dicta dolor enim harum laboriosam nam quasi. Aliquam, aut autem, cupiditate distinctio dolorum ducimus eius et minima modi saepe, totam ut. A culpa cum cupiditate deserunt dolore dolorem dolores ea fugiat id laborum libero modi molestias mollitia nam necessitatibus odio officia optio provident ratione rem, similique, sunt suscipit, tenetur totam velit veniam veritatis? Commodi eos mollitia quae voluptas? Ad aliquam aliquid, commodi consectetur cupiditate delectus deserunt distinctio doloribus ea eveniet expedita fugit illo iusto, molestias perspiciatis possimus quasi repellendus repudiandae similique, sit ut velit voluptates. At cum deleniti dolore doloremque dolorum facere facilis, laudantium nam nesciunt quaerat quas qui, quis quisquam sequi ut. Explicabo modi possimus unde. Autem cupiditate dolorem error, eum excepturi exercitationem fuga id iste minus nesciunt nihil nulla odio omnis quam quasi rem repellendus sunt temporibus ut vero. Accusantium dolorum explicabo in laudantium provident tempore ullam! Commodi delectus eius iusto nihil ratione vel! Consequuntur corporis cumque debitis dignissimos distinctio dolorem dolores eos error eveniet ex excepturi exercitationem iste itaque labore laudantium molestiae, nemo nihil officia, pariatur placeat possimus quaerat quam quibusdam rerum sequi soluta sunt voluptas voluptates voluptatibus voluptatum? Aliquam blanditiis commodi eligendi eos error expedita facilis incidunt minus nobis perferendis quas reiciendis repellendus saepe vitae, voluptates? Accusamus accusantium adipisci alias asperiores corporis debitis doloribus iure molestiae nemo nulla, saepe tempore voluptate voluptatem. Beatae consequuntur delectus, dicta doloribus dolorum eos, in laborum laudantium minima nisi omnis, placeat possimus provident quaerat quisquam quos repellat repellendus sed similique totam vel veniam voluptas voluptatibus. Ab adipisci, blanditiis dicta dolor fugiat, illo mollitia nesciunt nulla recusandae reiciendis rerum tempora, velit! Assumenda commodi inventore libero minus modi placeat porro quae, quam quasi ratione saepe sint tenetur, veniam vero voluptatem! Accusamus, at blanditiis distinctio, eaque error eveniet facere magnam mollitia neque numquam quasi sunt voluptates. At cum dolore laboriosam odio vero?', 'uploads/post/rasim_php.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone`, `role`) VALUES
(1, 'admin', '123', 'nurali2004@gmail.com', '+998992904445', 1),
(2, 'student', '123', 'shahzod003@gmail.com', '+99899299102045', 2),
(3, 'student', '456', 'Ilhom003@gmail.com', '+998992995040', 2),
(4, 'oqituvchi', '123', 'info@samtuit.uz', '+9983838784845', 2),
(5, 'Nurali', '1234', 'nurali2004@gmail.com', NULL, 2),
(8, 'vohidjon', '456', 'vohidjon004@gmail.com', NULL, 2),
(9, 'vohidjon', '456', 'vohidjon004@gmail.com', NULL, 2),
(12, 'Nurali', '1234', 'mavzurovnurali@gmail.com', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
