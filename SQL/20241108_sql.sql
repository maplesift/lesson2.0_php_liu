SELECT  `students`.`id`,
        `students`.`school_num`,
        `students`.`name`,
        `classes`.`name`,
        `class_student`.`seat_num`,
        `class_student`.`class_code`
FROM    `students`,`classes`,`class_student`
WHERE   `students`.`school_num`=`class_student`.`school_num` &&
        `classes`.`code`=`class_student`.`class_code`;
         