<?
//SSHDB

function sshdb_parser_msg($sshdb_msg){
	switch(SSHDB_LANG){
	case 'kr' : 
		switch($sshdb_msg){
			case 0 : $msg = 'DB 연결이 안되어 있습니다.';break;
			case 1 : $msg = 'DB 연결이 되었습니다.';break;
			case 2 : $msg = 'DB Key가 존재하지 않습니다.';break;
			case 3 : $msg = 'DB연결에 성공했습니다.';break;
			case 4 : $msg = 'DB Key가 잘못되었습니다.';break;
			case 5 : $msg = '(치명적인 오류) 입력 값 중 입력 불가 문자가 있습니다.';break;
			case 6 : $msg = 'DB ID값이 입력되지 않았습니다.';break;
			case 7 : $msg = 'ID값으로 사용 불가합니다.';break;
			case 8 : $msg = 'DB가 이미 존재합니다.';break;
			case 9 : $msg = '입력 형식이 잘못되었습니다.';break;
			case 10 : $msg = 'DB를 생성했습니다.';break;
			case 11 : $msg = '속성 값이 입력되지 않았습니다.';break;
			case 12 : $msg = '변환 값이 입력되지 않았습니다.';break;
			case 13 : $msg = '해당 값은 편집할 수 없는 속성 값입니다.';break;
			case 14 : $msg = '해당 변화 값은 ID값으로 사용할 수 없습니다.';break;
			case 15 : $msg = 'DB가 존재하지 않습니다.';break;
			case 16 : $msg = '속성 값이 중복됩니다.';break;
			case 17 : $msg = 'DB가 수정되었습니다.';break;
			case 18 : $msg = 'DB를 삭제했습니다.';break;
			case 19 : $msg = 'DB 값이 중복됩니다.';break;
			case 20 : $msg = '값을 반환했습니다.';break;
			case 21 : $msg = 'TABLE ID값이 입력되지 않았습니다.';break;
			case 22 : $msg = 'TABLE 값이 중복됩니다.';break;
			case 23 : $msg = 'TABLE이 이미 존재합니다.';break;
			case 24 : $msg = 'TABLE이 존재하지 않습니다.';break;
			case 25 : $msg = 'TABLE을 생성했습니다.';break;
			case 26 : $msg = 'TABLE이 수정되었습니다.';break;
			case 27 : $msg = 'TABLE을 삭제했습니다.';break;
			case 28 : $msg = 'VAR 값이 중복됩니다.';break;
			case 29 : $msg = 'VAR가 이미 존재합니다.';break;
			case 30 : $msg = 'VAR를 생성했습니다.';break;
			case 31 : $msg = 'VAR가 존재하지 않습니다.';break;
			case 32 : $msg = 'VAR가 수정되었습니다.';break;
			case 33 : $msg = 'VAR 값이 입력되지 않았습니다.';break;
			case 34 : $msg = '변경할 수 없는 속성 값입니다.';break;
			case 35 : $msg = 'VAR 값을 삭제했습니다.';break;
			case 36 : $msg = 'ELEMENT 값이 중복됩니다.';break;
			case 37 : $msg = 'ELEMENT가 이미 존재합니다.';break;
			case 38 : $msg = 'ELEMENT를 생성했습니다.';break;
			case 39 : $msg = 'ELEMENT가 존재하지 않습니다.';break;
			case 40 : $msg = 'ELEMENT가 수정되었습니다.';break;
			case 41 : $msg = 'ELEMENT 값이 입력되지 않았습니다.';break;
			case 42 : $msg = 'ELEMENT 값을 삭제했습니다.';break;
			case 43 : $msg = '정렬 값이 정해지지 않았습니다.';break;
			case 44 : $msg = '해당 정렬 방법이 잘못되었습니다.';break;
			case 45 : $msg = '해당 정렬 유형이 잘못되었습니다.';break;
			case 46 : $msg = '정렬 값을 적용했습니다.';break;
			case 47 : $msg = 'LINK경로가 잘못되었습니다.';break;
			case 48 : $msg = 'LINK를 생성했습니다.';break;
			case 49 : $msg = 'LINK 폴더에 접근 권한이 없습니다.';break;
			case 50 : $msg = 'LINK의 경로를 입력하세요.';break;
			case 51 : $msg = 'LINK경로 끝에 \'/\' 혹은 \'\\\'를 포함해야 합니다.(한 가지의 구분으로 통일해야 합니다.)';break;
			case 52 : $msg = 'LINK가 이미 존재합니다.(LINK는 DB와 같이 취급합니다.)';break;
			case 53 : $msg = 'LINK 경로 값이 입력되지 않았습니다.';break;
			case 54 : $msg = '해당 DB는 LINK가 아닙니다.';break;
			case 55 : $msg = 'LINK가 수정되었습니다.';break;
			case 56 : $msg = '해당 LINK의 경로를 반환했습니다.';break;
			case 57 : $msg = '백업을 생성했습니다.';break;
			case 58 : $msg = 'TABLE의 레이아웃을 반환했습니다.';break;
			case 59 : $msg = '백업의 목록을 반환했습니다.';break;
			case 60 : $msg = '백업은 동시간에 한번만 수행합니다.(서버시간 기준)';break;
			case 61 : $msg = '백업이 존재하지 않습니다.';break;
			case 62 : $msg = '백업의 레이아웃을 반환했습니다.';break;
			case 63 : $msg = '백업 값이 중복됩니다.';break;
			case 64 : $msg = '백업을 삭제했습니다.';break;
			case 65 : $msg = '백업을 푸시했습니다.';break;
			case 66 : $msg = '템플릿 ID값이 입력되지 않았습니다.';break;
			case 67 : $msg = '템플릿 ID값이 중복됩니다.';break;
			case 68 : $msg = '템플릿이 이미 존재합니다.';break;
			case 69 : $msg = '템플릿을 생성했습니다.';break;
			case 70 : $msg = '템플릿이 존재하지 않습니다.';break;
			case 71 : $msg = '템플릿을 삭제했습니다.';break;
			case 72 : $msg = '템플릿 목록을 반환했습니다.';break;
			case 73 : $msg = '템풀릿을 푸쉬했습니다.';break;
			case 74 : $msg = 'ELEMENT가 존재하지 않습니다.';break;
			case 75 : $msg = 'GET 할 속성이 존재하지 않습니다.';break;
			case 76 : $msg = '검색 할 속성이 존재하지 않습니다.';break;
			case 77 : $msg = '검색 옵션 값이 잘못되었습니다.';break;
			case 78 : $msg = '검색 옵션 값이 중복됩니다.';break;
			case 79 : $msg = 'LOG 푸시에 오류가 발생했습니다.';break;
			case 80 : $msg = 'DB Key를 수정했습니다.';break;
			case 81 : $msg = 'DB Key ID값이 입력되지 않았습니다.';break;
			case 82 : $msg = 'DB Key Password 값이 입력되지 않았습니다.';break;
			case 83 : $msg = '입력한 값의 형식이 잘못되었습니다.';break;
			case 84 : $msg = 'Data폴더(하위 폴더 포함)에 접근 권한이 없습니다.';break;
			case 85 : $msg = 'DB Key가 생성되었습니다.';break;
			case 86 : $msg = 'DB Key가 이미 존재합니다.';break;
			case 87 : $msg = 'LOG를 조회했습니다.';break;
			case 88 : $msg = 'LOG의 목록을 가져왔습니다.';break;
			case 89 : $msg = 'LOG가 존재하지 않습니다.';break;
			case 90 : $msg = 'LOG의 속성 값이 잘못되었습니다.';break;
			case 91 : $msg = '해당 LOG를 삭제했습니다.';break;
			case 92 : $msg = 'LOG 속성이 중복됩니다.';break;
			case 93 : $msg = '해당 구조 속성이 존재하지 않습니다.';break;
			case 94 : $msg = 'TABLE의 전체 내용을 반환했습니다.';break;
			case 95 : $msg = '검색 할 값이 존재하지 않습니다.';break;
			case 96 : $msg = '검색 결과 해당 값은 존재하지 않습니다.';break;
			case 97 : $msg = '해당 세팅 값은 존재하지 않습니다.';break;
			case 98 : $msg = '세팅 값을 수정했습니다.';break;
			case 99 : $msg = '해당 테이블을 XML 형식으로 출력했습니다.';break;
			case 100 : $msg = '';break;
			case 101 : $msg = '';break;

		}
	break;
	
	case 'en' : 
	break;
	}
	
	
	
	// return $msg;
	echo $msg.'
';
}
?>